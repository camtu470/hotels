<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['rooms', 'services', 'promotion'])
            ->orderByRaw("FIELD(status, 'pending', 'cancelled', 'confirmed')")
            ->latest();
    
        // Lọc theo trạng thái nếu có
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Lọc theo số điện thoại nếu có
        if ($request->filled('guest_phone')) {
            $query->where('guest_phone', 'like', '%' . $request->guest_phone . '%');
        }
    
        $bookings = $query->paginate(10);
    
        return view('admin.bookings.index', compact('bookings'));
    }
    
    public function show(Booking $booking)
{
    // Đảm bảo load các quan hệ liên quan
    $booking->load(['rooms', 'services', 'promotion']);

    return view('admin.bookings.show', compact('booking'));
}

    public function getRoomsByHotel($hotelId)
{
    $rooms = Room::with('floor') // load thông tin tầng
                ->where('hotel_id', $hotelId)
                ->where('status', 'available')
                ->get(['id', 'name', 'type', 'price_per_night', 'floor_id']);

    return response()->json($rooms);
}


public function create()
{
    $hotels = Hotel::all(); // <- Thêm nếu chưa có
    $services = Service::all(); // <- Dòng này để load tất cả dịch vụ
    $promotions = Promotion::where('status', 'active')
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->get();

    return view('admin.bookings.create', compact('hotels', 'services', 'promotions'));
}

public function store(Request $request)
{
    $request->validate([
        'guest_name' => 'required|string|max:255',
        'guest_phone' => 'required|string|max:20',
        'guest_email' => 'nullable|email',
        'guest_id_number' => 'required|string|max:50',
        'check_in_date' => 'required|date',
        'check_out_date' => 'required|date|after_or_equal:check_in_date',
        'room_ids' => 'required|array',
        'room_prices' => 'required|array',
        'service_ids' => 'array',
        'service_quantities' => 'array',
        'payment_method' => 'required|string',
        'promotion_code' => 'nullable|string',
        'status' => 'required|in:pending,confirmed,cancelled'
    ]);

    $checkIn = Carbon::parse($request->check_in_date);
    $checkOut = Carbon::parse($request->check_out_date);
    $nights = $checkOut->diffInDays($checkIn);

    if ($nights <= 0) {
        return back()->withErrors(['check_out_date' => 'Ngày trả phòng phải lớn hơn ngày nhận phòng.']);
    }

    // Kiểm tra trùng phòng + trùng ngày
    foreach ($request->room_ids as $roomId) {
        $overlappingBooking = DB::table('booking_room')
            ->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
            ->where('booking_room.room_id', $roomId)
            ->where('bookings.status', '!=', 'cancelled') // bỏ qua các booking bị hủy
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('bookings.check_in_date', [$checkIn, $checkOut->copy()->subDay()])
                    ->orWhereBetween('bookings.check_out_date', [$checkIn, $checkOut->copy()->subDay()])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('bookings.check_in_date', '<=', $checkIn)
                          ->where('bookings.check_out_date', '>=', $checkOut->copy()->subDay());
                    });
            })
            ->exists();

        if ($overlappingBooking) {
            return back()->withErrors([
                'room_ids' => 'Phòng đã được đặt trong khoảng thời gian này. Vui lòng chọn phòng khác hoặc thay đổi ngày.'
            ]);
        }
    }

    DB::beginTransaction();

    try {
        $promotion = null;
        if ($request->promotion_code) {
            $promotion = Promotion::where('code', $request->promotion_code)
                ->where('status', 'active')
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->first();
        }

        $booking = Booking::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'guest_name' => $request->guest_name,
            'guest_phone' => $request->guest_phone,
            'guest_email' => $request->guest_email,
            'guest_id_number' => $request->guest_id_number,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'payment_method' => $request->payment_method,
            'promotion_id' => $promotion?->id,
            'total_amount' => 0,
            'status' => $request->status,
        ]);

        // Tính tổng tiền phòng
        $totalRoom = 0;
        foreach ($request->room_ids as $index => $roomId) {
            $pricePerNight = $request->room_prices[$index];
            $roomTotal = $pricePerNight * $nights;

            $booking->rooms()->attach($roomId, [
                'price_per_night' => $pricePerNight,
                'nights' => $nights,
                'total_price' => $roomTotal,
            ]);

            $totalRoom += $roomTotal;
        }

        // Tính tổng tiền dịch vụ
        $totalService = 0;
        $selectedServiceIds = $request->input('service_ids', []);
        $quantities = $request->input('service_quantities', []);

        foreach ($selectedServiceIds as $serviceId) {
            $service = Service::findOrFail($serviceId);
            $quantity = $quantities[$serviceId] ?? 1;
            $unitPrice = $service->price;
            $total = $unitPrice * $quantity;

            $booking->services()->attach($serviceId, [
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $total,
            ]);

            $totalService += $total;
        }

        $discount = $promotion?->discount_value ?? 0;
        $totalAmount = max($totalRoom + $totalService - $discount, 0);

        $booking->total_amount = $totalAmount;
        $booking->save();

        DB::commit();

        return redirect()->route('bookings.index')->with('success', 'Đặt phòng thành công!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Lỗi: ' . $e->getMessage()]);
    }
}

public function getBlockedDates($roomId)
{
    $bookings = Booking::whereHas('rooms', fn($q) => $q->where('rooms.id', $roomId))
        ->where('status', '!=', 'cancelled')
        ->get(['check_in_date', 'check_out_date']);

    $blockedDates = [];

    foreach ($bookings as $booking) {
        $current = Carbon::parse($booking->check_in_date);
        $end = Carbon::parse($booking->check_out_date);

        // Thu thập tất cả các ngày từ check_in đến check_out (bao gồm)
        while ($current->lte($end)) {
            $blockedDates[] = $current->format('Y-m-d');
            $current->addDay();
        }
    }

    // Loại trùng lặp ngày
    $blockedDates = array_unique($blockedDates);

    return response()->json(array_values($blockedDates));
}



    public function updateStatus(Request $request, Booking $booking)
{
    $request->validate([
        'status' => 'required|in:pending,confirmed,cancelled',
    ]);

    $booking->status = $request->status;
    $booking->save();

    return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
}

}
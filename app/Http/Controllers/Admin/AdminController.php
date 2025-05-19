<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Floor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $hotels = Hotel::all();
        $selectedHotelId = $request->hotel_id;
        $searchPhone = $request->search_phone;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        $bookings = collect();
        $totalRooms = 0;
        $availableRooms = 0;
        $pendingBookings = 0;
        $totalRevenue = 0;
        $totalFloors = 0;
        $selectedHotel = null;

        if ($selectedHotelId) {
            $selectedHotel = Hotel::find($selectedHotelId);
            $roomIds = Room::where('hotel_id', $selectedHotelId)->pluck('id');

            $bookingsQuery = Booking::with(['rooms', 'services'])
                ->whereHas('rooms', fn($q) => $q->whereIn('rooms.id', $roomIds));

            if ($searchPhone) {
                $bookingsQuery->where('guest_phone', 'like', '%' . $searchPhone . '%');
            }

            if ($dateFrom) {
                $bookingsQuery->whereDate('check_in_date', '>=', $dateFrom);
            }
            if ($dateTo) {
                $bookingsQuery->whereDate('check_out_date', '<=', $dateTo);
            }

            $bookings = $bookingsQuery->latest()->paginate(10)->withQueryString();

            $totalRooms = Room::where('hotel_id', $selectedHotelId)->count();
            $availableRooms = Room::where('hotel_id', $selectedHotelId)->where('status', 'available')->count();
            $pendingBookings = Booking::whereHas('rooms', fn($q) => $q->whereIn('rooms.id', $roomIds))
                ->where('status', 'pending')->count();

            $revenueQuery = Booking::whereHas('rooms', fn($q) => $q->whereIn('rooms.id', $roomIds))
                ->where('status', 'confirmed');

            if ($dateFrom) {
                $revenueQuery->whereDate('check_in_date', '>=', $dateFrom);
            }
            if ($dateTo) {
                $revenueQuery->whereDate('check_out_date', '<=', $dateTo);
            }

            $totalRevenue = $revenueQuery->sum('total_amount');

            // Tính tổng số lầu (tầng)
            $floorIds = Room::where('hotel_id', $selectedHotelId)->pluck('floor_id')->unique();
            $totalFloors = Floor::whereIn('id', $floorIds)->count();
        }

        return view('admin.dashboard', compact(
            'hotels',
            'selectedHotelId',
            'bookings',
            'totalRooms',
            'availableRooms',
            'pendingBookings',
            'totalRevenue',
            'searchPhone',
            'dateFrom',
            'dateTo',
            'totalFloors',
            'selectedHotel'
        ));
    }
}
<?php

namespace App\Http\Controllers\Customer;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;

class CustomerController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('customer.index', compact('branches'));
    }
    public function searchRoom(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);
    
        $branchId = $request->branch_id;
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
    
        $rooms = Room::whereHas('hotel', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in_date', '<', $checkOut)
                      ->where('check_out_date', '>', $checkIn);
                });
            })
            ->with(['hotel', 'images', 'amenities']) // load thêm nếu cần
            ->get();
    
        return view('customer.available_rooms', compact('rooms', 'branchId', 'checkIn', 'checkOut'));
    }
}
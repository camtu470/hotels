<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\Amenity;
use App\Models\Hotel;
use App\Models\Floor;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with(['hotel', 'floor', 'images', 'amenities']);
    
        if ($request->filled('hotel_id')) {
            $query->where('hotel_id', $request->hotel_id);
        }
    
        if ($request->filled('floor_id')) {
            $query->where('floor_id', $request->floor_id);
        }
    
        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('price_min')) {
            $query->where('price_per_night', '>=', $request->price_min);
        }
    
        if ($request->filled('price_max')) {
            $query->where('price_per_night', '<=', $request->price_max);
        }
    
        $rooms = $query->get();
    
        // Gửi thêm danh sách hotels, floors để hiển thị form lọc
        $hotels = Hotel::all();
        $floors = Floor::all();
    
        return view('admin.rooms.index', compact('rooms', 'hotels', 'floors'));
    }
    
    public function show($id)
    {
        $room = Room::with(['hotel', 'floor', 'images', 'amenities'])->findOrFail($id);
        return view('admin.rooms.show', compact('room'));
    }

    public function map(Request $request)
    {
        $hotels = Hotel::all();
        $hotelId = $request->input('hotel_id');
        $selectedHotel = null;
        $rooms = collect();
    
        if ($hotelId) {
            $selectedHotel = Hotel::find($hotelId);
            if ($selectedHotel) {
                // Lấy tất cả phòng của khách sạn đã chọn
                $rooms = Room::with(['floor', 'images', 'amenities'])
                    ->where('hotel_id', $hotelId)
                    ->get();
            }
        }
    
        return view('admin.rooms.map', compact('hotels', 'selectedHotel', 'rooms', 'hotelId'));
    }
    

    public function create()
    {
        $hotels = Hotel::all();
        $floors = Floor::all();
        $amenities = Amenity::all();
        return view('admin.rooms.create', compact('hotels', 'floors', 'amenities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'floor_id' => 'required|exists:floors,id',
            'name' => 'required|string|max:255',
            'price_per_night' => 'required|numeric',
            'type' => 'required|string',
            'status' => 'required|in:available,unavailable,use',
            'images' => 'nullable|array',
            'images.*' => 'nullable|url',
            'amenities' => 'nullable|array',
        ]);
    
        $room = Room::create($request->only([
            'hotel_id', 'floor_id', 'name', 'price_per_night', 'type', 'status'
        ]));
    
        // Lưu hình ảnh nếu có
        if ($request->has('images')) {
            foreach ($request->images as $url) {
                if (!empty($url)) {
                    $room->images()->create(['image_url' => $url]);
                }
            }
        }
    
        if ($request->has('amenities')) {
            foreach ($request->amenities as $name) {
                if (!empty($name)) {
                    $room->amenities()->create([
                        'name' => $name
                    ]);
                }
            }
        }
        
    
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }
    

    public function edit($id)
    {
        $room = Room::with(['images', 'amenities'])->findOrFail($id);
        $hotels = Hotel::all();
        $floors = Floor::all();
        $amenities = Amenity::all();
        return view('admin.rooms.edit', compact('room', 'hotels', 'floors', 'amenities'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
    
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'floor_id' => 'required|exists:floors,id',
            'name' => 'required|string|max:255',
            'price_per_night' => 'required|numeric',
            'type' => 'required|string',
            'status' => 'required|in:available,unavailable,use',
            'images' => 'nullable|array',
            'images.*' => 'nullable|url',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string'
        ]);
    
        $room->update($request->only([
            'hotel_id', 'floor_id', 'name', 'price_per_night', 'type', 'status'
        ]));
    
        // Cập nhật hình ảnh: xóa cũ, thêm mới
        $room->images()->delete();
        if ($request->has('images')) {
            foreach ($request->images as $url) {
                if (!empty($url)) {
                    $room->images()->create(['image_url' => $url]);
                }
            }
        }
    
        $room->amenities()->delete();

        if ($request->has('amenities')) {
            foreach ($request->amenities as $name) {
                if (!empty($name)) {
                    $room->amenities()->create([
                        'name' => $name
                    ]);
                }
            }
        }
        
    
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }
    
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->images()->delete();
        $room->amenities()->delete();

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
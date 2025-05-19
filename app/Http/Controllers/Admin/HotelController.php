<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $branch_id = $request->input('branch_id');
        $year = $request->input('year');

        $branches = Branch::all();

        $years = Hotel::select(DB::raw('YEAR(start) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $hotels = Hotel::with('branch')
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                      ->orWhere('description', 'like', '%' . $keyword . '%');
            })
            ->when($branch_id, function ($query, $branch_id) {
                $query->where('branch_id', $branch_id);
            })
            ->when($year, function ($query, $year) {
                $query->whereYear('start', $year);
            })
            ->get();

        return view('admin.hotel.index', compact('hotels', 'branches', 'years', 'keyword', 'branch_id', 'year'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('admin.hotel.create', compact('branches'));
    }
    public function getRooms($hotelId)
{
    $rooms = \App\Models\Room::where('hotel_id', $hotelId)->where('status', 'available')->get();

    return response()->json($rooms);
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'branch_id' => 'required|exists:branches,id',
            'start' => 'required|date',
            'description' => 'nullable',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'images.*' => 'nullable|url',
            'amenities.*' => 'nullable|string|max:255',
        ]);

        $hotel = Hotel::create($request->only([
            'name', 'branch_id', 'start', 'description', 'phone', 'address', 'email'
        ]));

        // Lưu hình ảnh
        if ($request->has('images')) {
            foreach ($request->images as $url) {
                if (!empty($url)) {
                    $hotel->images()->create(['image_url' => $url]);
                }
            }
        }

        // Lưu tiện ích
        if ($request->has('amenities')) {
            foreach ($request->amenities as $name) {
                if (!empty($name)) {
                    $hotel->amenities()->create(['name' => $name]);
                }
            }
        }

        return redirect()->route('hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function edit(Hotel $hotel)
    {
        $branches = Branch::all();
        $hotel->load(['images', 'amenities']);
        return view('admin.hotel.edit', compact('hotel', 'branches'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required',
            'branch_id' => 'required|exists:branches,id',
            'start' => 'required|date',
            'description' => 'nullable',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|url',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
        ]);

        $hotel->update([
            'name' => $request->name,
            'branch_id' => $request->branch_id,
            'start' => $request->start,
            'description' => $request->description,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        // Cập nhật hình ảnh
        $hotel->images()->delete();
        if ($request->has('images')) {
            foreach ($request->images as $url) {
                if (!empty($url)) {
                    $hotel->images()->create(['image_url' => $url]);
                }
            }
        }

        // Cập nhật tiện ích
        $hotel->amenities()->delete();
        if ($request->has('amenities')) {
            foreach ($request->amenities as $name) {
                if (!empty($name)) {
                    $hotel->amenities()->create(['name' => $name]);
                }
            }
        }

        return redirect()->route('hotels.index')->with('success', 'Hotel updated.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel deleted.');
    }
}
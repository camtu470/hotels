<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $query = Promotion::query();
    
        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('min_price')) {
            $query->where('discount_value', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $query->where('discount_value', '<=', $request->max_price);
        }
    
        $promotions = $query->get();
    
        return view('admin.promotion.index', compact('promotions'));
    }
    

    public function create()
    {
        return view('admin.promotion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        Promotion::create($request->all());
        return redirect()->route('promotions.index')->with('success', 'Promotion created successfully.');
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('admin.promotion.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);

        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        $promotion->update($request->all());
        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy($id)
    {
        Promotion::destroy($id);
        return redirect()->route('promotions.index')->with('success', 'Promotion deleted successfully.');
    }
}
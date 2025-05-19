<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index()
    {
        $floors = Floor::all();
        return view('admin.floors.index', compact('floors'));
    }

    public function create()
    {
        return view('admin.floors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Floor::create($request->all());

        return redirect()->route('floors.index')->with('success', 'Floor created successfully.');
    }

    public function edit($id)
    {
        $floor = Floor::findOrFail($id);
        return view('admin.floors.edit', compact('floor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $floor = Floor::findOrFail($id);
        $floor->update($request->all());

        return redirect()->route('floors.index')->with('success', 'Floor updated successfully.');
    }

    public function destroy($id)
    {
        Floor::destroy($id);

        return redirect()->route('floors.index')->with('success', 'Floor deleted successfully.');
    }
}
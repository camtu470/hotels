<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::all();
        return view('admin.guests.index', compact('guests'));
    }

    public function create()
    {
        return view('admin.guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:guests,email',
            'cmnd' => 'required|unique:guests,cmnd',
        ]);

        Guest::create($request->only(['name', 'phone', 'email', 'cmnd']));

        return redirect()->route('guests.index')->with('success', 'Guest created successfully.');
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('admin.guests.edit', compact('guest'));
    }

    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:guests,email,' . $id,
            'cmnd' => 'required|unique:guests,cmnd,' . $id,
        ]);

        $guest->update($request->only(['name', 'phone', 'email', 'cmnd']));

        return redirect()->route('guests.index')->with('success', 'Guest updated successfully.');
    }

    public function destroy($id)
    {
        Guest::destroy($id);
        return redirect()->route('guests.index')->with('success', 'Guest deleted successfully.');
    }
}
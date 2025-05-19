<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
  

    public function index(Request $request)
    {
        $name = $request->input('name');
        $year = $request->input('year');
    
        // Lấy danh sách các năm có trong created_at
        $years = Branch::select(DB::raw('YEAR(created_at) as year'))
                    ->distinct()
                    ->orderBy('year', 'desc')
                    ->pluck('year');
    
        $branches = Branch::when($name, function ($query, $name) {
                            $query->where('name', 'like', '%' . $name . '%');
                        })
                        ->when($year, function ($query, $year) {
                            $query->whereYear('created_at', $year);
                        })
                        ->get();
    
        return view('admin.branch.index', compact('branches', 'name', 'year', 'years'));
    }
    

    public function create()
    {
        return view('admin.branch.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Branch::create($request->all());
        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branch.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $request->validate([
            'name' => 'required',
  
        ]);

        $branch->update($request->all());
        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        Branch::destroy($id);
        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }
}
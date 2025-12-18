<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::all();
        return view('Tools.offices.index', compact('offices'));
    }

    public function create()
    {
        return view('Tools.offices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|max:255',
            'office_code' => 'required|max:50|unique:offices,office_code',
        ]);

        Office::create($request->all());

        return redirect()->route('tools.offices.index')->with('success', 'Office created successfully.');
    }

    public function edit(Office $office)
    {
        return view('Tools.offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $request->validate([
            'office_name' => 'required|max:255',
            'office_code' => 'required|max:50|unique:offices,office_code,' . $office->id,
        ]);

        $office->update($request->all());

        return redirect()->route('tools.offices.index')->with('success', 'Office updated successfully.');
    }

    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('tools.offices.index')->with('success', 'Office deleted successfully.');
    }
}

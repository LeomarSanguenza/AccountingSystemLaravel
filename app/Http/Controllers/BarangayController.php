<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    public function index()
    {
        $barangays = Barangay::all();
        return view('tools.barangays.index', compact('barangays'));
    }

    public function create()
    {
        return view('tools.barangays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barangay_name' => 'required|string|max:255',
            'barangay_code' => 'required|string|max:100|unique:barangays,barangay_code',
        ]);

        Barangay::create($request->all());

        return redirect()->route('tools.barangays.index')->with('success', 'Barangay created successfully.');
    }

    public function edit(Barangay $barangay)
    {
        return view('tools.barangays.edit', compact('barangay'));
    }

    public function update(Request $request, Barangay $barangay)
    {
        $request->validate([
            'barangay_name' => 'required|string|max:255',
            'barangay_code' => 'required|string|max:100|unique:barangays,barangay_code,' . $barangay->id,
        ]);

        $barangay->update($request->all());

        return redirect()->route('tools.barangays.index')->with('success', 'Barangay updated successfully.');
    }

    public function destroy(Barangay $barangay)
    {
        $barangay->delete();
        return redirect()->route('tools.barangays.index')->with('success', 'Barangay deleted successfully.');
    }
}

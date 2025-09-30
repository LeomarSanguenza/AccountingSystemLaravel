<?php

namespace App\Http\Controllers;

use App\Models\Signatory;
use Illuminate\Http\Request;

class SignatoryController extends Controller
{
    public function index()
    {
        $signatories = Signatory::all();
        return view('Tools/signatories.index', compact('signatories'));
    }

    public function create()
    {
        return view('Tools/signatories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'office' => 'required|max:255',
            'position' => 'required|max:255',
            'designation' => 'required|max:255',
        ]);

        Signatory::create($request->all());

        return redirect()->route('Tools/signatories.index')->with('success', 'Signatory created successfully.');
    }

    public function edit(Signatory $signatory)
    {
        return view('Tools/signatories.edit', compact('signatory'));
    }

    public function update(Request $request, Signatory $signatory)
    {
        $request->validate([
            'name' => 'required|max:255',
            'office' => 'required|max:255',
            'position' => 'required|max:255',
            'designation' => 'required|max:255',
        ]);

        $signatory->update($request->all());

        return redirect()->route('Tools/signatories.index')->with('success', 'Signatory updated successfully.');
    }

    public function destroy(Signatory $signatory)
    {
        $signatory->delete();
        return redirect()->route('Tools/signatories.index')->with('success', 'Signatory deleted successfully.');
    }
}

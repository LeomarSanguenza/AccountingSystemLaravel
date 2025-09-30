<?php

namespace App\Http\Controllers;

use App\Models\FundType;
use Illuminate\Http\Request;

class FundTypeController extends Controller
{
    public function index()
    {
        $fundtypes = FundType::all();
        return view('Tools/fundtypes.index', compact('fundtypes'));
    }

    public function create()
    {
        return view('Tools/fundtypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:255',
            'code'        => 'required|string|max:255|unique:fundtypes,code',
            'alias'       => 'nullable|string|max:255',
        ]);

        FundType::create($request->all());

        return redirect()->route('Tools/fundtypes.index')
                         ->with('success', 'Fund Type created successfully.');
    }

    public function show(FundType $fundtype)
    {
        return view('Tools/fundtypes.show', compact('fundtype'));
    }

    public function edit(FundType $fundtype)
    {
        return view('Tools/fundtypes.edit', compact('fundtype'));
    }

    public function update(Request $request, FundType $fundtype)
    {
        $request->validate([
            'description' => 'nullable|string|max:255',
            'code'        => 'required|string|max:255|unique:fundtypes,code,' . $fundtype->id,
            'alias'       => 'nullable|string|max:255',
        ]);

        $fundtype->update($request->all());

        return redirect()->route('Tools/fundtypes.index')
                         ->with('success', 'Fund Type updated successfully.');
    }

    public function destroy(FundType $fundtype)
    {
        $fundtype->delete();

        return redirect()->route('Tools/fundtypes.index')
                         ->with('success', 'Fund Type deleted successfully.');
    }
}

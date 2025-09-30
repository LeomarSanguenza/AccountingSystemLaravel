<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('tools/banks.index', compact('banks'));
    }

    public function create()
    {
        return view('tools/banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_code' => 'required|string|max:100|unique:banks,bank_code',
            'bank_key' => 'required|string|max:100',
            'bank_address' => 'nullable|string|max:255',
        ]);

        Bank::create($request->all());

        return redirect()->route('tools/banks.index')->with('success', 'Bank created successfully.');
    }

    public function edit(Bank $bank)
    {
        return view('tools/banks.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_code' => 'required|string|max:100|unique:banks,bank_code,' . $bank->id,
            'bank_key' => 'required|string|max:100',
            'bank_address' => 'nullable|string|max:255',
        ]);

        $bank->update($request->all());

        return redirect()->route('tools/banks.index')->with('success', 'Bank updated successfully.');
    }

/*************  ✨ Windsurf Command ⭐  *************/
/*******  03a20e1e-29c4-4be8-9092-59894662e602  *******/
    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->route('tools/banks.index')->with('success', 'Bank deleted successfully.');
    }
}

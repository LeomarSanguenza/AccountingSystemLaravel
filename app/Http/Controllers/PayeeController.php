<?php

namespace App\Http\Controllers;

use App\Models\Payee;
use Illuminate\Http\Request;

class PayeeController extends Controller
{
    public function index()
    {
        $payees = Payee::all();
        return view('payees.index', compact('payees'));
    }

    public function create()
    {
        return view('payees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payee_name' => 'required|max:255',
        ]);

        Payee::create($request->all());

        return redirect()->route('payees.index')->with('success', 'Payee created successfully.');
    }

    public function edit(Payee $payee)
    {
        return view('payees.edit', compact('payee'));
    }

    public function update(Request $request, Payee $payee)
    {
        $request->validate([
            'payee_name' => 'required|max:255',
        ]);

        $payee->update($request->all());

        return redirect()->route('payees.index')->with('success', 'Payee updated successfully.');
    }

    public function destroy(Payee $payee)
    {
        $payee->delete();
        return redirect()->route('payees.index')->with('success', 'Payee deleted successfully.');
    }
}

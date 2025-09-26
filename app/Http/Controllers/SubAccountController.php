<?php

namespace App\Http\Controllers;

use App\Models\SubAccount;
use App\Models\AccountCode;
use Illuminate\Http\Request;

class SubAccountController extends Controller
{
    public function index()
    {
        $subAccounts = SubAccount::with('accountCode')->get();
        return view('subaccounts.index', compact('subAccounts'));
    }

    public function create()
    {
        $accountCodes = AccountCode::all();
        return view('subaccounts.create', compact('accountCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_code_id' => 'required|exists:account_codes,acct_title_id',
            'sub_code' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        SubAccount::create($request->all());

        return redirect()->route('subaccounts.index')->with('success', 'Sub Account created successfully.');
    }

    public function edit(SubAccount $subaccount)
    {
        $accountCodes = AccountCode::all();
        return view('subaccounts.edit', compact('subaccount', 'accountCodes'));
    }

    public function update(Request $request, SubAccount $subaccount)
    {
        $request->validate([
            'account_code_id' => 'required|exists:account_codes,acct_title_id',
            'sub_code' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        $subaccount->update($request->all());

        return redirect()->route('subaccounts.index')->with('success', 'Sub Account updated successfully.');
    }

    public function destroy(SubAccount $subaccount)
    {
        $subaccount->delete();
        return redirect()->route('subaccounts.index')->with('success', 'Sub Account deleted successfully.');
    }
}

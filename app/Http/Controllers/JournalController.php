<?php

// app/Http/Controllers/JournalController.php
namespace App\Http\Controllers;

use App\Models\JournalHeader;
use App\Models\JournalDetail;
use App\Models\ExpenseType;
use App\Models\FundType;
use App\Models\Payee;
use App\Models\Tag;
use App\Models\AccountCode;
use Illuminate\Http\Request;
use App\Models\Office;
use DB;

class JournalController extends Controller
    {
    public function index()
    {
        $journals = JournalHeader::withCount('details')->latest()->paginate(10);
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        $expenseTypes = ExpenseType::pluck('name', 'id');
        $fundTypes    = FundType::pluck('description', 'id');
        $payees       = Payee::pluck('payee_name', 'id');
        $tags         = Tag::pluck('description', 'tags_id');
        $accounts     = AccountCode::pluck('description', 'full_code');
        $offices      = Office::pluck('office_name', 'id');

        return view('journals.create', compact('offices', 'expenseTypes', 'fundTypes', 'payees', 'tags', 'accounts'));
    }

    public function store(Request $request)
    {
        DB::transaction(function() use ($request) {
            // Save header
            $header = JournalHeader::create($request->only([
                'gen_code','journal_entry_no','voucher_no','series',
                'office_id','expens_type','particulars','fundtype',
                'journal_type','entrydate','obligation_no','payee_no',
                'tin','address','debit_total','credit_total','main_tag',
                'cash_flow','asset_link','period','subperiod','active'
            ]));

            // Save details
            foreach ($request->details as $detail) {
                $header->details()->create($detail);
            }
        });

        return redirect()->back()->with('success','Journal saved successfully!');
    }

    public function edit($id)
        {
            $header = JournalHeader::with('details')->findOrFail($id);
            return view('journals.edit', compact('header'));
        }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $header = JournalHeader::findOrFail($id);
            $header->update($request->only([
                'gen_code','journal_entry_no','voucher_no','series',
                'office_id','expens_type','particulars','fundtype',
                'journal_type','entrydate','obligation_no','payee_no',
                'tin','address','debit_total','credit_total','main_tag',
                'cash_flow','asset_link','period','subperiod','active'
            ]));

            // Delete old details & reinsert
            $header->details()->delete();
            foreach ($request->details as $detail) {
                $header->details()->create($detail);
            }
        });

        return redirect()->route('journals.index')->with('success', 'Journal updated successfully!');
    }

    public function destroy($id)
    {
        JournalHeader::findOrFail($id)->delete();
        return redirect()->route('journals.index')->with('success', 'Journal deleted.');
    }

}

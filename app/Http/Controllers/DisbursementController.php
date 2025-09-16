<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisbursementHeader;
use App\Models\DisbursementDetail;
use App\Models\AccountCode; // Assuming you have an AccountCode model
use App\Models\Bmso\ObligationRequest;
use Illuminate\Support\Facades\DB;


class DisbursementController extends Controller
{
    /**
     * Show all disbursements
     */
    public function index()
    {
        $headers = DisbursementHeader::with('details')->get();
        return view('disbursements.index', compact('headers'));
    }

    public function create()
    {
        $accountCodes = AccountCode::all();
        // dd($accountCodes);
    return view('disbursements.create', compact('accountCodes'));
    }

    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {

            $header = DisbursementHeader::create($request->only([
                'date_of_voucher', 'mode_of_payment', 'fund_type',
                'voucher_number', 'obligation_number', 'responsibility_center',
                'fpp', 'payee', 'tin', 'address', 'date_of_check',
                'bank', 'check_number', 'check_amount', 'date_of_or',
                'or_document', 'jev_no', 'particulars', 'status', 'active'
            ]));

            foreach ($request->details as $detail) {
                $header->details()->create($detail);
            }
        });

        return redirect()->route('disbursements.index')->with('success', 'Disbursement created successfully!');
    }

    /**
     * Edit form
     */
    public function edit($id)
    {
        $accountCodes = AccountCode::all();
        $header = DisbursementHeader::with('details')->findOrFail($id);
        // dd($header);
        return view('disbursements.edit', compact('header', 'accountCodes'));
    }

    /**
     * Update disbursement
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $header = DisbursementHeader::findOrFail($id);
            
            $header->update($request->only([
                'date_of_voucher', 'mode_of_payment', 'fund_type',
                'voucher_number', 'obligation_number', 'responsibility_center',
                'fpp', 'payee', 'tin', 'address', 'date_of_check',
                'bank', 'check_number', 'check_amount', 'date_of_or',
                'or_document', 'jev_no', 'particulars', 'status', 'active'
            ]));

            // delete old details and re-insert
            $header->details()->delete();

            foreach ($request->details as $detail) {
                $detail['debit']  = $detail['debit']  !== '' ? $detail['debit']  : null;
                $detail['credit'] = $detail['credit'] !== '' ? $detail['credit'] : null;

                $header->details()->create($detail);    
            }
        });

        return redirect()->route('disbursements.index')->with('success', 'Disbursement updated successfully!');
    }

    /**
     * Delete disbursement
     */
    public function destroy($id)
    {
        $header = DisbursementHeader::findOrFail($id);
        $header->details()->delete();
        $header->delete();

        return redirect()->route('disbursements.index')->with('success', 'Disbursement deleted!');
    }
    public function createFromObr($obrId)
    {
        // Grab OBR with entries
        $obr = ObligationRequest::with('entries')->findOrFail($obrId);
        $accountCodes = \App\Models\AccountCode::all();

        return view('disbursements.create', [
            'obr' => $obr,
            'accountCodes' => $accountCodes
        ]);
    }
}

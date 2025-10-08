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
        $payees = \App\Models\Payee::all();
        $headers = DisbursementHeader::with('details', 'payeeRecord')->get();
        return view('disbursements.index', compact('headers'));
    }

   public function create()
{
    $accountCodes = AccountCode::all();

    // no OBR context, make sure view receives these as null
    $bmsoPayee = null;
    $accountingPayee = null;

    return view('disbursements.create', compact('accountCodes', 'bmsoPayee', 'accountingPayee'));
}

public function createFromObr($obrId)
{
    // Grab OBR with entries
    $obr = ObligationRequest::with('entries')->findOrFail($obrId);
    $accountCodes = AccountCode::all();

    // bmso payee coming from the bmso DB
    $bmsoPayee = BmsoPayees::find($obr->payee_id);

    // try to resolve corresponding accounting payee by ref_id
    $accountingPayee = Payee::where('ref_id', $bmsoPayee?->id)->first();

    return view('disbursements.create', [
        'obr' => $obr,
        'accountCodes' => $accountCodes,
        'bmsoPayee' => $bmsoPayee,
        'accountingPayee' => $accountingPayee,
    ]);
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
public function approve($id)
{
    $this->authorize('approve_disbursement');

    $hdr = DisbursementHeader::findOrFail($id);
    $hdr->status = 2; // Approved
    $hdr->save();

    return back()->with('success', 'Disbursement approved!');
}
public function reject($id)

{
    $this->authorize('approve_disbursement');
    $hdr = DisbursementHeader::findOrFail($id);
    $hdr->status = 7; // Approved
    $hdr->save();
    return view('disbursements.show', compact('header'));
}

public function process($id)
{
    $this->authorize('process_disbursement');

    $hdr = DisbursementHeader::findOrFail($id);
    $hdr->status = 4; // Document Processing
    $hdr->save();

    return back()->with('success', 'Disbursement processing started!');
}

public function cancel($id)
{
    $this->authorize('cancel_disbursement');

    $hdr = DisbursementHeader::findOrFail($id);
    $hdr->status = 7; // Cancelled
    $hdr->save();

    return back()->with('success', 'Disbursement cancelled!');
}
public function statusInfo()
{
    return $this->belongsTo(\App\Models\DisbStatus::class, 'status', 'id');
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

}

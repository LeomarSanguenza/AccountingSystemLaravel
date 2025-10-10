<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisbursementHeader;
use App\Models\DisbursementDetail;
use App\Models\AccountCode; // Assuming you have an AccountCode model
use App\Models\Bmso\ObligationRequest;
use App\Models\Bmso\Payees;
use Illuminate\Support\Facades\DB;
use App\Models\Payee;

class DisbursementController extends Controller
{
    /**
     * Show all disbursements
     */
    public function index()
    {
        $payees = \App\Models\Payee::all();
        $headers = DisbursementHeader::with('details', 'payeeRecord')->get();
        // $user = auth()->user();
        // $alias = $user->fundTypeRelation->alias;
        // dd($alias);
        return view('disbursements.index', compact('headers'));
    }

public function create()
{
    $accountCodes = AccountCode::all();
    $user = auth()->user();

    [$dvPrefix, $nextNumber] = $this->getDvPrefixAndNextNumber($user);

    // No OBR here, so set payee vars to null
    $bmsoPayee = null;
    $accountingPayee = null;

    return view('disbursements.create', compact(
        'accountCodes',
        'bmsoPayee',
        'accountingPayee',
        'dvPrefix',
        'nextNumber'
    ));
}

private function getDvPrefixAndNextNumber($user)
{
    $alias = $user->fundTypeRelation->alias ?? '000';
    $yearMonth = date('Y-m'); // e.g. "2025-10"
    $prefix = "{$alias}-{$yearMonth}";

    $latest = DisbursementHeader::where('dv_number', 'like', "{$prefix}-%")
        ->orderBy('dv_number', 'desc')
        ->first();

    if ($latest && preg_match('/-(\d+)$/', $latest->dv_number, $m)) {
        $nextNumber = intval($m[1]) + 1;
    } else {
        $nextNumber = 1;
    }

    return [$prefix, $nextNumber];
}
public function createFromObr($obrId)
{
    $obr = ObligationRequest::with('entries')->findOrFail($obrId);
    $accountCodes = AccountCode::all();
    $user = auth()->user();

    // Be consistent with model name — Payee vs Payees (see note below)
    $bmsoPayee = Payees::find($obr->payee_id); // or Payee::find(...) if model name is singular
    $accountingPayee = Payee::where('ref_id', $bmsoPayee?->id)->first();

    if ((int) $obr->fund_type_id !== (int) $user->fundtype) {
        return redirect()->back()
            ->withErrors(['fund_type' => 'This OBR does not belong to your fund type.']);
    }

    [$dvPrefix, $nextNumber] = $this->getDvPrefixAndNextNumber($user);

    return view('disbursements.create', compact(
        'obr',
        'accountCodes',
        'bmsoPayee',
        'accountingPayee',
        'dvPrefix',
        'nextNumber'
    ));
}


    // public function store(Request $request)
    // {   
    //     // $user = auth()->user();
    //     // $alias = $user->fundTypeRelation->alias;
    //     // dd($alias);
        

    //     DB::transaction(function () use ($request) {

    //         $header = DisbursementHeader::create($request->only([
    //             'date_of_voucher', 'mode_of_payment', 'fund_type',
    //             'voucher_number', 'obligation_number', 'responsibility_center',
    //             'fpp', 'payee', 'tin', 'address', 'date_of_check',
    //             'bank', 'check_number', 'check_amount', 'date_of_or',
    //             'or_document', 'jev_no', 'particulars', 'status', 'active'
    //         ]));

    //         foreach ($request->details as $detail) {
    //             $header->details()->create($detail);
    //         }
    //     });

    //     return redirect()->route('disbursements.index')->with('success', 'Disbursement created successfully!');
    // }
public function store(Request $request)
{   
    $user = auth()->user();

    // Get alias safely
    $alias = $user->fundTypeRelation->alias ?? 'NA'; 

    // Build full DV number from request
    $dvNumber = $request->full_dv_number;

    // 1️⃣ Validate that DV number is unique before continuing
    if (DisbursementHeader::where('dv_number', $dvNumber)->exists()) {
        return back()
            ->withErrors(['dv_number' => 'That DV number is already taken.'])
            ->withInput();
    }

    // 2️⃣ Validate basic input (optional but smart)
    $validated = $request->validate([
        'date_of_voucher' => 'required|date',
        'mode_of_payment' => 'required|string',
        'fund_type' => 'required',
        'payee' => 'required|string',
        'details' => 'required|array|min:1',
        'details.*.account_code' => 'required|string',
        'details.*.amount' => 'required|numeric|min:0',
    ]);

    // 3️⃣ Wrap everything in a transaction
    DB::transaction(function () use ($validated, $dvNumber) {

        $header = DisbursementHeader::create(array_merge(
            $validated,
            ['dv_number' => $dvNumber]
        ));

        // Create detail rows
        foreach ($validated['details'] as $detail) {
            $header->details()->create($detail);
        }
    });

    // 4️⃣ Redirect on success
    return redirect()
        ->route('disbursements.index')
        ->with('success', "Disbursement {$dvNumber} created successfully!");
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

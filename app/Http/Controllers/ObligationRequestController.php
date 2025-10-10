<?php

namespace App\Http\Controllers;
use App\Models\Bmso\ObligationRequest;

class ObligationRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Only get requests where fund_type matches the user's fundtype
        $requests = ObligationRequest::with('entries')
            ->where('fund_type_id', $user->fundtype)
            ->paginate(10);

        return view('obligations.index', compact('requests'));
    }


    public function show($id)
    {
        $request = ObligationRequest::with('entries')->findOrFail($id);

        return view('obligations.show', compact('request'));
    }
}

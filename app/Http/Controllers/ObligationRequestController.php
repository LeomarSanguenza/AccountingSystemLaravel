<?php

namespace App\Http\Controllers;
use App\Models\Bmso\ObligationRequest;

class ObligationRequestController extends Controller
{
    public function index()
    {
        // Load requests with their entries
        $requests = ObligationRequest::with('entries')->paginate(10);

        return view('obligations.index', compact('requests'));
    }

    public function show($id)
    {
        $request = ObligationRequest::with('entries')->findOrFail($id);

        return view('obligations.show', compact('request'));
    }
}

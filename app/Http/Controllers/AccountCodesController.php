<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisbursementHeader;
use App\Models\DisbursementDetail;
use Illuminate\Support\Facades\DB;

class AccountCodesController extends Controller
{
    public function index()
    {
        $headers = DisbursementHeader::with('details')->get();
        return view('account_codes.index', compact('headers'));
    }
}
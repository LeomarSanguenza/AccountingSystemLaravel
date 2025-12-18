<?php

namespace App\Models\Bmso;

use Illuminate\Database\Eloquent\Model;

class Payees extends Model
{
    //
    protected $connection = 'navotas_bms';   // Use secondary DB
    protected $table = 'claimant_payees';
    protected $primaryKey = 'id';
}

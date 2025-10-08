<?php

namespace App\Models\Bmso;

use Illuminate\Database\Eloquent\Model;

class Payees extends Model
{
    //
    protected $connection = 'bmso';   // Use secondary DB
    protected $table = 'claimant_payees';
    protected $primaryKey = 'id';
}

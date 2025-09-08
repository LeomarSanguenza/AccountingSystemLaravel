<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementHeader extends Model
{
    use HasFactory;

    protected $table = 'disbursement_headers';
    protected $primaryKey = 'dv_hdr_id';

    protected $fillable = [
        'date_of_voucher',
        'mode_of_payment',
        'fund_type',
        'dv_number',
        'obligation_number',
        'responsibility_center',
        'fpp',
        'payee',
        'tin',
        'address',
        'date_of_check',
        'bank',
        'check_number',
        'check_amount',
        'date_of_or',
        'or_document',
        'jev_no',
        'particulars',
        'status',
        'active',
    ];

    public function details()
    {
        return $this->hasMany(DisbursementDetail::class, 'dv_hdr_id', 'dv_hdr_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementDetail extends Model
{
    use HasFactory;

    protected $table = 'disbursement_details';
    protected $primaryKey = 'dv_detail_id';

    protected $casts = [
    'debit' => 'decimal:2',
    'credit' => 'decimal:2',
    ];

    public function setDebitAttribute($value)
    {
        $this->attributes['debit'] = str_replace(',', '', $value);
    }

    public function setCreditAttribute($value)
    {
        $this->attributes['credit'] = str_replace(',', '', $value);
    }

    protected $fillable = [
        'dv_hdr_id',
        'account_codes',
        'sub_account',
        'fpp',
        'fpp_category',
        'debit',
        'credit',
        'total',
        'active',
    ];

    public function header()
    {
        return $this->belongsTo(DisbursementHeader::class, 'dv_hdr_id', 'dv_hdr_id');
    }
}

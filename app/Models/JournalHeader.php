<?php

// app/Models/JournalHeader.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalHeader extends Model
{
    protected $table = 'journal_headers';
    protected $primaryKey = 'hdr_id';
    public $timestamps = false; 

    protected $fillable = [
        'gen_code','journal_entry_no','voucher_no','series',
        'office_id','expens_type','particulars','fundtype',
        'journal_type','entrydate','obligation_no','payee_no',
        'tin','address','debit_total','credit_total','main_tag',
        'cash_flow','asset_link','period','subperiod','active'
    ];

    public function details() {
        return $this->hasMany(JournalDetail::class, 'hdr_id');
    }
}

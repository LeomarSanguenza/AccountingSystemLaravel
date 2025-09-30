<?php

// app/Models/JournalDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalDetail extends Model
{
    protected $table = 'journal_details';
    protected $primaryKey = 'general_id';
    public $timestamps = true; 

    protected $fillable = [
        'hdr_id','gen_code','journal_entry_no','voucher_no','series',
        'edit_code','jev','fundtype','entrydate','office_id','expense_types',
        'account_code','account_sublevel','explaination',
        'debit_amount','credit_amount','subperiod','description','active',
        'lastupdatedby'
    ];
}

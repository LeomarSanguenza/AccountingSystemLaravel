<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAccount extends Model
{
    use HasFactory;

    protected $table = 'sub_accounts';

    protected $fillable = [
        'account_code_id',
        'sub_code',
        'description',
        'active',
    ];

    public function accountCode()
    {
        return $this->belongsTo(AccountCode::class, 'account_code_id', 'acct_title_id');
    }
}

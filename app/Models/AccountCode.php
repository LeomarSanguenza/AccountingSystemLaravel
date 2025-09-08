<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCode extends Model
{
    use HasFactory;

    // Table name (optional, since Laravel will pluralize AccountCode -> account_codes)
    protected $table = 'account_codes';

    // Primary key
    protected $primaryKey = 'acct_title_id';

    // Auto-incrementing primary key
    public $incrementing = true;

    // Key type
    protected $keyType = 'int';

    // Timestamps (if your table doesn’t have created_at / updated_at)
    public $timestamps = false;

    // Fillable fields
    protected $fillable = [
        'acct_lvl1',
        'acct_lvl2',
        'acct_lvl3',
        'acct_code',
        'full_code',
        'description',
        'alt_description_101',
        'alt_description_221',
        'alt_description_401',
        'active',
    ];
}

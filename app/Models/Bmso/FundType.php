<?php

namespace App\Models\Bmso;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundType extends Model
{
    use HasFactory;

    // Tell Laravel the table name (with bmso schema)
    protected $table = 'bmso.fund_types';

    // Set primary key
    protected $primaryKey = 'id';

    // If your table doesn’t have created_at/updated_at
    public $timestamps = false;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'fund_code',
    ];
}

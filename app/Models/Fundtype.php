<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundType extends Model
{
    // Table name (since it's not the default plural form)
    protected $table = 'fundtypes';

    // Primary key
    protected $primaryKey = 'id';

    // Mass assignable columns
    protected $fillable = [
        'description',
        'code',
        'alias',
    ];

    // If you don’t have created_at/updated_at
    public $timestamps = false;
     public function users()
    {
        return $this->hasMany(User::class, 'fundtype', 'id');
    }
}

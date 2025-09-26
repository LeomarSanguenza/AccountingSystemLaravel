<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    protected $fillable = [
        'name',
        'office',
        'position',
        'designation',
    ];
}

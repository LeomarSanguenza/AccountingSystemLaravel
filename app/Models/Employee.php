<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'EmpID';
    public $timestamps = true;

    protected $fillable = [
        'FirstName',
        'LastName',
        'Position',
        'Salary',
        'Gender',
        'Birthdate'
    ];
}

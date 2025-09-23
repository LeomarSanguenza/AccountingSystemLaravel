<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extend Authenticatable
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'UserID';
    protected $with = ['fundTypeRelation'];

    protected $fillable = [
        'FirstName',
        'LastName',
        'Username',
        'Password',
        'UserRole',
        'fund_type'
    ];

    protected $hidden = [
        'Password',  // Hide password when serializing the model
        'remember_token',
    ];

    /**
     * Override the method to get the auth password.
     * Note: Laravel expects the password field to be named "password" (lowercase).
     * If your database column is "Password" (uppercase), override getAuthPassword.
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }
    // public function fundtype()
    // {
    //     return $this->belongsTo(FundType::class, 'fundtype', 'id'); 

    // }   
    // User.php
    public function fundTypeRelation()
    {
        return $this->belongsTo(FundType::class, 'fundtype', 'id');
    }


}

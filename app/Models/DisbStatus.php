<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisbStatus extends Model
{
    // Table name
    protected $table = 'disb_status';

    // Primary key
    protected $primaryKey = 'id';

    // No timestamps (since your table doesn’t have created_at / updated_at)
    public $timestamps = false;

    // Fillable fields
    protected $fillable = [
        'status_name',
    ];

    /**
     * Each status can be linked to many DisbursementHeaders
     */
    public function disbursements()
    {
        return $this->hasMany(\App\Models\DisbursementHeader::class, 'status', 'id');
    }
}
    
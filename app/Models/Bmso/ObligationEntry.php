<?php
// app/Models/Bmso/ObligationEntry.php
namespace App\Models\Bmso;

use Illuminate\Database\Eloquent\Model;

class ObligationEntry extends Model
{
    protected $connection = 'bmso';   // Use secondary DB
    protected $table = 'obligation_entries';
    protected $primaryKey = 'id';     // adjust if needed

    public function request()
    {
        return $this->belongsTo(ObligationRequest::class, 'obr_id', 'id');
    }
}

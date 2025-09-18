<?php
// app/Models/Bmso/ObligationRequest.php
namespace App\Models\Bmso;

use Illuminate\Database\Eloquent\Model;

class ObligationRequest extends Model
{
    protected $connection = 'bmso';   // Use secondary DB
    protected $table = 'obligation_requests';
    protected $primaryKey = 'id';     // adjust if your PK is different

    public function entries()
    {
        return $this->hasMany(ObligationEntry::class, 'obr_id', 'id');
    }
    public function fundType()
    {
        return $this->belongsTo(FundType::class, 'fund_type_id', 'id');
    }

}


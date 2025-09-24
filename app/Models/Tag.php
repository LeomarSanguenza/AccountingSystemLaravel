<?php

// app/Models/Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = 'tags_id';
    protected $fillable = ['description', 'journal_type', 'fundtype'];

    public function fundTypeRelation()
    {
        return $this->belongsTo(FundType::class, 'fundtype', 'id');
    }
}
    
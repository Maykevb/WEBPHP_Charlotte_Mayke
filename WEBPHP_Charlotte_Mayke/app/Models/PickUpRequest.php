<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickUpRequest extends Model
{
    protected $fillable = [
        'title',
        'startDate',
        'endDate'
    ];

    public function Shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}

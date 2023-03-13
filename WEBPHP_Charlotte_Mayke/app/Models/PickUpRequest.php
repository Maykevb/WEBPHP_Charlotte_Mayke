<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickUpRequest extends Model
{
    protected $fillable = [
        'date',
        'time',
        'streetName',
        'houseNumber',
        'postalCode'
    ];

    public function Shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}

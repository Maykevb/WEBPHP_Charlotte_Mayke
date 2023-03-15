<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'name',
        'place',
        'streetName',
        'houseNumber',
        'postalCode'
    ];

    public function Label()
    {
        return $this->belongsTo(Label::class);
    }

    public function PickUpRequest()
    {
        return $this->belongsTo((PickUpRequest::class));
    }
}

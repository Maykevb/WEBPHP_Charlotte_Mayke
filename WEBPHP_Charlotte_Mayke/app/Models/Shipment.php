<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'streetName',
        'houseNumber',
        'postalCode'
    ];

    public function Label()
    {
        return $this->belongsTo(Label::class);
    }
}

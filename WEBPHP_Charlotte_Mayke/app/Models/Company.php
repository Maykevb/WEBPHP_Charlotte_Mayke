<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'naam',
        'prijs',
        'streetName',
        'houseNumber',
        'postalCode'
    ];
}

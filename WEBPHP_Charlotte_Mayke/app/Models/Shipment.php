<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'streetName',
        'houseNumber',
        'postalCode',
    ];

    public function Label()
    {
        return $this->belongsTo(Label::class);
    }

    public static function Test($street, $nr, $code) {
        return [
            'id' => 1,
            'streetName' => $street,
            'houseNumber' => $nr,
            'postalCode' => $code,
        ];
    }
}

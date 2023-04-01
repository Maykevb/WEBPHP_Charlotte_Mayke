<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Shipment extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'name',
        'place',
        'streetName',
        'houseNumber',
        'postalCode',
        'status',
        'webshop'
    ];

    public function Label()
    {
        return $this->belongsTo(Label::class);
    }

    public function PickUpRequest()
    {
        return $this->belongsTo((PickUpRequest::class));
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'place' => $this->place,
            'streetName' => $this->streetName,
            'houseNumber' => $this->houseNumber,
            'postalCode' => $this->postalCode,
            'webshop' => $this->webshop
        ];
    }
}

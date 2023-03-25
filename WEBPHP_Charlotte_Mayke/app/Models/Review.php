<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'text',
        'stars',
        'shipment_id',
        'account_id'
    ];

    public function Shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function User() {
        return $this->belongsTo(user::class);
    }
}

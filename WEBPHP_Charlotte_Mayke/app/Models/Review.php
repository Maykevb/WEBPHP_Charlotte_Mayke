<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Review extends Model
{
    use Searchable;

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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'stars' => $this->stars,
            'shipment_id' => $this->shipment_id,
            'account_id' => $this->account_id
        ];
    }
}

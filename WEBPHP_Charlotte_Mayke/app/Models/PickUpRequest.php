<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickUpRequest extends Model
{
    protected $fillable = [
        'start',
        'end',
        'time',
        'title',
        'postcode',
        'huisnummer'
    ];
}

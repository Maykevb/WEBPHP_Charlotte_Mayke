<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickUpRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'time',
        'title',
        'postcode',
        'huisnummer',
        'webshop'
    ];
}

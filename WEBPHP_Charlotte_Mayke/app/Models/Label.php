<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'barcode',
        'trackAndTrace',
        'streetName',
        'houseNumber',
        'postalCode',
        'postbedrijf'
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}

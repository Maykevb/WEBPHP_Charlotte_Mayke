<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'barcode'
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}

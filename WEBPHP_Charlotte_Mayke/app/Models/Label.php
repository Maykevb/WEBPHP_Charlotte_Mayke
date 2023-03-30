<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'trackAndTrace'
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}

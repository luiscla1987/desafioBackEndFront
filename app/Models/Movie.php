<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'sinopse',
        'duration',
        'directors',
        'writers',
        'stars',
        'rating',
        'image'
    ];

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}

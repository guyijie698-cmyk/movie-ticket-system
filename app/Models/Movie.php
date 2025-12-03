<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'poster',
        'duration',
        'release_date',
        'genre',
        'rating',
        'price'
    ];

    protected $dates = [
        'release_date'
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'price' => 'decimal:2',
        'duration' => 'integer'
    ];
}

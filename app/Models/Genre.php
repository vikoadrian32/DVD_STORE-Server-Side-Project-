<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'genres';

    // 1 genre bisa dimiliki banyak film 
    public function films():BelongsToMany
    {
        return $this->belongsToMany(Film::class,'film_genres');
    }
}


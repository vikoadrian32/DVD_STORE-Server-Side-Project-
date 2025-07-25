<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';

    // 1 film bisa memiliki banyak genre
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class,'film_genres');
    }
    // 1 film bisa memiliki banyak attribute
    public function attribute(): HasOne
    {
        return $this->hasOne(Detail::class);
    }
    // 1 film hanya untuk 1 stok
    public function stok():HasOne
    {
        return $this->hasOne(Stok::class);
    }
    // 1 film bisa memiliki banyak order 
    public function orders():HasMany{
        return $this->hasMany(Order::class);
    }
    
    

}

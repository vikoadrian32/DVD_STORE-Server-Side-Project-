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

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class,'film_genres');
    }
    public function attributes(): HasMany
    {
        return $this->hasMany(Detail::class);
    }

    public function stok():HasOne
    {
        return $this->hasOne(Stok::class);
    }
    

}

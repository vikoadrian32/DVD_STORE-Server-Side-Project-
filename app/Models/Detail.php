<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    use HasFactory;

    protected $table ="attributes_films";
    // protected $fillable = ["film_id","trailer","poster","thumbnail"];

    public function film():BelongsTo 
    {
        return $this->belongsTo(Film::class,'film_id','id');
    }
}

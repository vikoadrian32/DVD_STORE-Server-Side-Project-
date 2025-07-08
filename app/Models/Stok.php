<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stok extends Model
{
    
    use HasFactory;
    protected $table = 'stoks';
    public function film() :BelongsTo
    {
        return $this->belongsTo(Film::class,'film_id','id');
    }
    
}

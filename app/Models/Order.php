<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    // 1 order hanya untuk 1 account 
    public function Account():BelongsTo{
        return $this->belongsTo(Account::class);
    }
    
}

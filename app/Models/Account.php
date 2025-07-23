<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Account extends Model
{
    use HasFactory;
    protected $table='accounts';

    // User bisa memiliki banyak Order
    public function Orders():HasMany{
        return $this->hasMany(Order::class);
    }

}

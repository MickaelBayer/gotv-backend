<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'sun_id',
        'sun_name',
        'sun_price'
    ];
}

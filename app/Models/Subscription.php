<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $primaryKey = "sun_id";

    protected $fillable = [
        'sun_name',
        'sun_price'
    ];
}

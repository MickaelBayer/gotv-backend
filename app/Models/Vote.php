<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'voe_id',
    ];

    public function series()
    {
        return $this->hasMany('App\Models\Series');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}

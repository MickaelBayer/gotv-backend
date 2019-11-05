<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];

    public function series()
    {
        return $this->belongsTo('App\Models\Series', 'voe_see_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'voe_usr_id');
    }
}

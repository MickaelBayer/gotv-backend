<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $primaryKey = "voe_id";

    protected $fillable = [
        'voe_id',
    ];

    protected $hidden =  [
        'voe_see_id',
        'voe_usr_id'
    ];

    public function serie()
    {
        return $this->belongsTo('App\Models\Serie', 'voe_see_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'voe_usr_id');
    }
}

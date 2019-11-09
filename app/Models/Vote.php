<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $primaryKey = 'voe_id';

    protected $fillable = [
        'voe_usr_id',
        'voe_see_id',
        'voe_comment',
        'voe_mark'
    ];

    public function voe_see_id()
    {
        return $this->belongsTo('App\Models\Serie', 'voe_see_id');
    }

    public function voe_usr_id()
    {
        return $this->belongsTo('App\User', 'voe_usr_id');
    }
}

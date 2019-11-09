<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'evt_id';

    protected $fillable = [
        'evt_id'
    ];

    public function evt_plm_id()
    {
        return $this->belongsTo('App\Models\PlatformSerie', 'evt_plm_id');
    }
}

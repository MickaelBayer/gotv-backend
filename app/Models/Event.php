<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'evt_id'
    ];

    public function platform()
    {
        return $this->belongsTo('App\Models\PlatformSerie', 'evt_plm_id');
    }
}

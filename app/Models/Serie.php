<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'see_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\CatSerie', 'see_cae_id');
    }

    public function platform()
    {
        return $this->belongsTo('App\Models\PlatformSerie', 'see_plm_id');
    }
}

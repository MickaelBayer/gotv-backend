<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $primaryKey = "cae_id";
    
    protected $fillable = [
        'cae_id_tmdb',
        'cae_label'
    ];

    public function cae_series() {
        return $this->belongsToMany('App\Models\Serie', "categories_series", "cae_see_category", "cae_see_serie");
    }
}

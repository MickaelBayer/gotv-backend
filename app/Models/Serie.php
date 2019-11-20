<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $primaryKey = "see_id";

    protected $fillable = [
        'see_name',
        'see_tmdb_id',
        'see_original_country',
        'see_first_air_date',
        'see_original_lang',
        'see_overview',
        'see_poster_path',
        'see_backdrop_path'
    ];

    public function see_categories()
    {
        return $this->belongsToMany('App\Models\Categorie', "categories_series", "cae_see_serie", "cae_see_category");
    }

    public function see_votes()
    {
        return $this->hasMany('App\Models\Vote', "voe_see_id");
    }
}

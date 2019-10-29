<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $primaryKey = "see_id";

    protected $fillable = [
        'see_id',
        'see_name',
        'see_tmdb_id',
        'see_original_country',
        'see_first_air_date',
        'see_original_lang',
        'see_overview',
        'see_poster_path',
        'see_backdrop_path'
    ];

    protected $hidden =  [
        'see_cae_id',
        'see_plm_id'
    ];

    public function category()
    {
        return $this->belongsTo(App\Models\CatSerie::class, 'see_cae_id');
    }

    public function platform()
    {
        return $this->belongsTo(App\Models\PlatformSerie::class, 'see_plm_id');
    }

    public function votes()
    {
        return $this->hasMany(App\Models\Vote::class, 'voe_see_id');
    }
}

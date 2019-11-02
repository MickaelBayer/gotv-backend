<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
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
}

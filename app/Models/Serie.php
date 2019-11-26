<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $primaryKey = "see_id";

    protected $appends = ['see_average_mark'];

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

    public function getSeeAverageMarkAttribute()
    {
        $dico = array();

        foreach ($this->see_votes as $vote) {
            $operandResult = $vote->voe_mark * $vote->voe_user->usr_role->roe_coef;
            $dico[$operandResult] = $vote->voe_user->usr_role->roe_coef;
        }

        if (array_sum(array_values($dico)) != 0) {
            $result = array_sum(array_keys($dico)) / array_sum(array_values($dico));
            return self::getRoundedValue($result);
        }

        return 0;
    }

    public function see_votes()
    {
        return $this->hasMany('App\Models\Vote', "voe_see_id");
    }

    private static function getRoundedValue($value)
    {
        $sup = round($value);
        $inf = floor($value);
        $try = (float) $inf . '.5';

        if ($value > $try) {
            return $sup;
        }

        return $inf;
    }
}

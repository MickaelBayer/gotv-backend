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
        $voteValues = array();
        $roleCoefValues = array();
        foreach ($this->see_votes as $vote) {
            $operandResult = $vote->voe_mark * $vote->voe_user->usr_role->roe_coef;
            array_push($voteValues, $operandResult);
            array_push($roleCoefValues, $vote->voe_user->usr_role->roe_coef);
        }

        if (array_sum($roleCoefValues) != 0) {
            $result = array_sum($voteValues) / array_sum($roleCoefValues);
            $sup = round($result);
            $inf = floor($result);
            $try = (float) $inf . '.5';

            if ($result > $try) {
                return $sup;
            }

            return $inf;
        }
        return 0;
    }

    public function see_votes()
    {
        return $this->hasMany('App\Models\Vote', "voe_see_id");
    }
}

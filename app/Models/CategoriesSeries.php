<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesSeries extends Model
{
    protected $guarded = [];

    public function serie()
    {
        return $this->belongsTo('App\Models\Serie', 'see_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Categories', 'cae_id');
    }

}

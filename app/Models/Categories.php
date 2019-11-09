<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $primaryKey = "cae_id";
    
    protected $fillable = [
        'cae_id_tmdb',
        'cae_label'
    ];
}

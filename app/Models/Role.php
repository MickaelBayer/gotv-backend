<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = "roe_id";

    protected $fillable = [
        'roe_name',
        'roe_description'
    ];
}

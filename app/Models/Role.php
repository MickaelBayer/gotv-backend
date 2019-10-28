<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'roe_id',
        'roe_name',
        'roe_description'
    ];
}

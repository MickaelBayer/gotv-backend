<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformSerie extends Model
{
    protected $table = "platforms";

    protected $primaryKey = "plm_id";

    protected $fillable = [
        'plm_id'
    ];
}

<?php

namespace App;


use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    public $timestamps = false;

    protected $primaryKey = "usr_id";

    protected $fillable = [
        'usr_email',
        'usr_pseudo',
        'password',
        'usr_firstname',
        'usr_lastname',
        'usr_activ'
    ];

    protected $hidden =  [
        'password'
    ];

    public function usr_sun_id()
    {
        return $this->belongsTo('App\Models\Subscription', 'usr_sun_id');
    }

    public function usr_roe_id()
    {
        return $this->belongsTo('App\Models\Role', 'usr_roe_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getIsActiv()
    {
        return $this->usr_activ;
    }
}

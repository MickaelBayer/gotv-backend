<?php

namespace App;


use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class User extends Model implements AuthenticatableContract, AuthorizableContract
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
        'usr_activ',
        'usr_birthday',
        'usr_phone',
        'usr_postal_code',
        'usr_address',
        'usr_city',
        'usr_country'
    ];

    protected $hidden =  [
        'password',
        'usr_sun_id',
        'usr_roe_id'
    ];

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'usr_sun_id');
    }

    public function usr_role()
    {
        return $this->belongsTo('App\Models\Role', 'usr_roe_id');
    }

    public function usr_votes()
    {
        return $this->hasMany('App\Models\Vote', 'voe_usr_id');
    }
}

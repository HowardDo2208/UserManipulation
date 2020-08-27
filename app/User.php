<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{


    public static function getPaginate(){
        return DB::table('users')->paginate(5);
    }

    public function town(){
        return $this->belongsTo('App\Town', 'geoTownId');
    }
    public function townShip(){
        return $this->belongsTo('App\TownShip', 'geoTownShipId');
    }
    public function district(){
        return $this->belongsTo('App\District', 'geoDistrictId');
    }
    public function region(){
        return $this->belongsTo('App\Region', 'geoRegionId');
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'geoTownId', 'geoTownShipId', 'geoDistrictId', 'geoRegionId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

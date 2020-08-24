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
        try{
            return $this->town->townShip;
        }catch (\Throwable $e){
            return '';
        }
    }
    public function district(){
        try {
            return $this->townShip()->district;
        }catch (\Throwable $e){
            return '';
        }
    }
    public function region(){
        try {
            return $this->district()->region;
        }catch (\Throwable $e){
            return '';
        }
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'geoTownId'
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

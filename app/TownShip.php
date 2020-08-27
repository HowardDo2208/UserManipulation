<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TownShip extends Model
{
    protected $table = 'tbl_geotownship';
    protected $primaryKey = 'geoTownShipId';
    public function users(){
        return $this->hasMany('App\User', 'geoTownShipId');
    }
    public function towns(){
        return $this->hasMany('App\Town', 'geoTownShipId');
    }
    public function  district(){
        return $this->belongsTo('App\District', 'geoDistrictId');
    }
    public function region(){
        try{
            return $this->district->region;
        }catch (\Throwable $e){
            return '';
        }
    }


}

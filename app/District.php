<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'tbl_geodistrict';
    protected $primaryKey = 'geoDistrictId';


    public function townShips(){
        return $this->hasMany('App\TownShip', 'geoDistrictId');
    }
    public function region(){
        return $this->belongsTo('App\Region', 'geoRegionId');
    }
}

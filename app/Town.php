<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = 'tbl_geotown';
    protected $primaryKey = 'geoTownId';

    public function townShip(){
        return $this->belongsTo('App\TownShip', 'geoTownShipId');
    }
    public function district(){
        return $this->townShip->district;
    }
    public function region(){
        return $this->townShip->district->region;
    }
}

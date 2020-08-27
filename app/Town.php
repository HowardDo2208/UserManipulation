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
        try {
            return $this->townShip->district;
        }catch (\Throwable $e){
            return '';
        }
    }
    public function region(){
        try {
            return $this->townShip->district->region;
        }catch (\Throwable $e){
            return '';
        }
    }
}

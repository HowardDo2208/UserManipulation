<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'tbl_georegion';
    protected $primaryKey = 'geoRegionId';

    public function districts(){
        return $this->hasMany('App\District', 'geoRegionId');
    }
}

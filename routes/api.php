<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//GET GEO DATA FOR CREATE AND EDIT FORM DROPDOWNS
Route::get('getDistricts', function(Request $request) {
    $districtTable = DB::table('tbl_geodistrict');
    $correspondingDistricts = $districtTable->where('geoRegionId', $request->regionId);
    return response()->json($correspondingDistricts->select('geoDistrictId', 'geoDistrictName')->get());
});

Route::get('getTownShips', function(Request $request) {
    $townShipTable = DB::table('tbl_geotownship');
    $correspondingTownShip = $townShipTable->where('geoDistrictId', $request->districtId);
    return response()->json($correspondingTownShip->select('geoTownShipId', 'geoTownShipName')->get());
});

Route::get('getTowns', function(Request $request) {
    $townTable = DB::table('tbl_geotown');
    $correspondingTown = $townTable->where('geoTownShipId', $request->townShipId);
    return response()->json($correspondingTown->select('geoTownId', 'geoTownName')->get());
});


//GET REGION USER DATA TO DRAW CHART

Route::get('regionData', function (){
    $users = DB::table('users')
        ->select('tbl_georegion.geoRegionName',DB::raw('count(*) as user_count'))
        ->groupBy('tbl_georegion.geoRegionName');

    $result = $users->rightJoin('tbl_georegion','users.geoRegionId','=', 'tbl_geoRegion.geoRegionId')
        ->get()
        ->map(function ($user){
        return [$user->geoRegionName,$user->user_count];
    });
    return response()->json($result);
});



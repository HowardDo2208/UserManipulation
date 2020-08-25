<?php

namespace App\Http\Controllers;

use App\District;
use App\Region;
use App\Town;
use App\TownShip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        $users = User::getPaginate();
            return view('users.index', [
                'users' => $users,
                'page' => $users->currentPage()
            ]);
    }

    /**
     * Show the form for creating a new resource.

     */
    public function create()
    {
        $lastPage = User::getPaginate()->lastPage();
        return view('users.create',[
            'lastPage' => $lastPage,
            'regions' =>  Region::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
         request()->validate([
           'name' =>'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required_with:password|min:6',
             'geoTownId' => 'required',
             'geoTownShipId' => 'required',
             'geoDistrictId' => 'required',
             'geoRegionId' => 'required'
        ]);

        $user = new User(request([
            'name',
            'email',
            'password',
            'geoTownId',
            'geoTownShipId',
            'geoDistrictId',
            'geoRegionId'
        ]));
        $user->fill([
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return redirect('/home?page=' . $request->lastPage);
    }


    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit(User $user, int $page)
    {
        $districts = District::all()->where('geoRegionId', $user->geoRegionId);
        $townShips = TownShip::all()->where('geoDistrictId', $user->geoDistrictId);
        $towns = Town::all()->where('geoTownShipId', $user->geoTownShipId);
        return view('users.edit', [
            'user' => $user,
            'page' => $page,
            'regions' =>  Region::all(),
            'districts' => $districts,
            'townShips' => $townShips,
            'towns' => $towns,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user

     */
    public function update(Request $request, User $user)
    {
        if($user->email === $request->email){
            $user->update(request()->validate([
                'name' =>'required|max:255',
                'password' => 'min:8',
                'geoTownId' => 'required',
                'geoTownShipId' => 'required',
                'geoDistrictId' => 'required',
                'geoRegionId' => 'required'
            ]));
        }else{
            $user->update(request()->validate([
                'name' =>'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'min:8',
                'geoTownId' => 'required',
                'geoTownShipId' => 'required',
                'geoDistrictId' => 'required',
                'geoRegionId' => 'required',
            ]));
        }
        return redirect('/home/?page=' . $request->page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user

     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();
        return Redirect::back();
    }
}

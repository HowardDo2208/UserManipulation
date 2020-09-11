<?php

namespace App\Http\Controllers\Api;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Mail\ContactUser;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        if ($request->id) {
            return response() -> json(User::where('id',$request->id)->first());
        }
        $name = $request->name;
        $email = $request->email;

        $searchResults = User::where('name', 'LIKE', '%'.$name.'%')
            ->where('email', 'LIKE', '%'.$email.'%')
            ->orderBy('updated_at','desc');
        return response()->json($searchResults->get());
    }


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
    }



    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->update(request()->validate([
            'name' =>'required|max:255',
            'geoTownId' => 'required',
            'geoTownShipId' => 'required',
            'geoDistrictId' => 'required',
            'geoRegionId' => 'required'
        ]));
        if ($user->email !== $request->email) {
            $user->update(request()->validate([
                'email' => 'required|email|unique:users'
            ]));
        }
        if ($request->password) {
            request()->validate([
                'password' => 'min:8'
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
    }

    public function email(Request $request){
        Mail::to($request->email)
            ->send(new ContactUser($request->name));
    }

    public function export(Request $request){
        $userList = User::where('name', 'LIKE', '%'.$request->name.'%')
            ->where('email', 'LIKE', '%'.$request->email.'%')->get();
        return new UsersExport($userList);
    }
    public function chartData() {
        $users = DB::table('users')
            ->select('tbl_georegion.geoRegionName',DB::raw('count(*) as user_count'))
            ->groupBy('tbl_georegion.geoRegionName');

        $result = $users->rightJoin('tbl_georegion','users.geoRegionId','=', 'tbl_geoRegion.geoRegionId')
            ->get()
            ->map(function ($user){
                return [$user->geoRegionName,$user->user_count];
            });
        return response()->json($result);
    }
}

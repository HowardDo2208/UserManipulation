<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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
        $currentUser = auth()->user();
        $user = DB::table('users')->paginate('5');
            return view('home.admin', [
                'users' => $user,
            ]);

    }

    /**
     * Show the form for creating a new resource.

     */
    public function create()
    {
        return view('users.create');
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
            'password_confirmation' => 'required_with:password|min:6'
        ]);

        $user = new User(request([
            'name',
            'email',
            'password'
        ]));
        $user->fill([
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return redirect('/home');
    }


    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
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
                'password' => 'min:8'
            ]));
        }else{
            $user->update(request()->validate([
                'name' =>'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'min:8'
            ]));
        }
        return redirect('/home');
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
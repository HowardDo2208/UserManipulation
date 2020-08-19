<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(int $index)
    {
        $currentUser = auth()->user();
        $chunks = User::all()->chunk(5);

        if($currentUser->email === User::find(1)->email){

            return view('home.admin', [
                'users' => $chunks[$index-1],
                'pages' => $chunks->count(),
                'index' => $index
            ]);

        } else{
            return view('home.user');
        }
    }

}

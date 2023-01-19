<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        //dd => die and dump, Auth::user() => contient les infos de current user connecté
        //dd(Auth::user());
        //dd(Auth::user()->role);

        if(Auth::user()->role == "admin"){
            return redirect('/admin/dashboard');
        }else{
            return redirect('/client/dashboard');
        }
        //return view('home');
    }
}

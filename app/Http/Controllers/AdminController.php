<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    //fonction qui permet d'afficher le dashboard admin
    //admin.dashboard car le fichier dashboard est dans le dossier admin
    public function dashboard(){
        return view('admin.dashboard');
    }

    //fonction qui permet d'afficher le profile de l'admin
    public function profile(){
        return view('admin.profile');
    }

    //fonction qui permet de mettre à jour le profile de l'admin
    public function updateprofile(Request $request){
        //dd($request);

        //Auth::user() est du notre modèle User
        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;

        if($request->password){
            Auth::user()->password = Hash::make($request->password);
        }

        Auth::user()->update();


        return redirect('/admin/profile')->with('success', 'Admin est modifiée avec succèss');
        
    }


}

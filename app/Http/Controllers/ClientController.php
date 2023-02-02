<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    //
    //fonction qui permet d'afficher le dashboard client
    //client.dashboard car le fichier dashboard est dans le dossier client
    public function dashboard(){
        return view('client.dashboard');
    }

    //fonction qui permet d'afficher le profile du client
    public function profile(){
        return view('client.profile');
    }

    //fonction qui permet de mettre à jour le profile du client
    public function updateprofile(Request $request){
        //dd($request);

        //Auth::user() est du notre modèle User
        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;

        if($request->password){
            Auth::user()->password = Hash::make($request->password);
        }

        Auth::user()->update();


        return redirect('/client/profile')->with('success', 'Client est modifiée avec succèss');
        
    }
}

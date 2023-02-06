<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
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

    //fonction qui permet d'afficher la liste des clients
    public function clients(){

        //récupérer tous les clients de la base ni l'admin dans le role est user
        $clients = User::where('role', 'user')->get();

        return view('admin.clients.index')->with('clients', $clients);
    }

    //fonction qui permet de bloquer un client
    public function BloqueUser($iduser){

        //récupérer l'id de client
        $client = User::find($iduser);

        //changer l'état de true => false
        $client->is_active = false;

        //mise à jour
        $client->update();

        //redirection vers la meme page
        return redirect()->back()->with('success', 'Client est bloquée avec succèss');
    }

    //fonction qui permet de débloquer(activer) un client
    public function ActiveUser($iduser){

        //récupérer l'id de client
        $client = User::find($iduser);

        //changer l'état de false => true
        $client->is_active = true;

        //mise à jour
        $client->update();

        //redirection vers la meme page
        return redirect()->back()->with('success', 'Client est activée avec succèss');
    }



}

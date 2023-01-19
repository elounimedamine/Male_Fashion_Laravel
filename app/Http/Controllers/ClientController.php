<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    //fonction qui permet d'afficher le dashboard client
    //client.dashboard car le fichier dashboard est dans le dossier client
    public function dashboard(){
        return view('client.dashboard');
    }
}

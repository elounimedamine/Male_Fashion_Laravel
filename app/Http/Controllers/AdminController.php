<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    //fonction qui permet d'afficher le dashboard admin
    //admin.dashboard car le fichier dashboard est dans le dossier admin
    public function dashboard(){
        return view('admin.dashboard');
    }

}

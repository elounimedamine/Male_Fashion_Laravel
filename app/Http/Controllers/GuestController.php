<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    //fonction qui nous permet d'afficher le page d'acceuil pour le guest lors de l'exécution de l'application
    public function home(){
        //récupération de la liste des catégories
        $categories = Category::all();

        //récupération de la liste des produits
        $produits = Product::all();

        return view('guest.home')->with('categories', $categories)->with('produits', $produits);
    }
    
}

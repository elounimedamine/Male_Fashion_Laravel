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

    //fonction qui permet d'afficher les détails de chaque produits
    public function productDetails($id){

        //récupération de la liste des catégories
        $categories = Category::all();

        //récupération de produit sélectionnées selon leur id
        $product = Product::find($id);

        //récupération des produits différentes du produit sélectionnée selon leur id
        $products = Product::where('id', '!=', $id)->get();

        return view('guest.product-details')->with('categories', $categories)->with('product', $product)->with('products', $products);
    }

    //fonction pour afficher les produits d'une catégorie
    public function shop($idcategory){

        //récupération de l'id de catégorie sélectionnée
        $category = Category::find($idcategory);

        //récupération de la liste des produits d'une catégorie sélectionnées (category_id de la base de données = $idcategory)
        //$products = Product::where('category_id', $idcategory)->get();
        //products méthode dans le model Product(en le fait à travers les relations entre les 2 modèles Category et Product)
        $products = $category->products;

        //pour voir le liste des produits affichées pour chaque catégories
        //dd($products);

        //récupération de la liste des catégories
        $categories = Category::all();

        return view('guest.shop')->with('categories', $categories)->with('products', $products);
    }

    //fonction pour chercher un produit au hasard
    public function search(Request $request){

        //dd($request);
        //dd($request->keywords);

        //pour retourner le produit cherchée selon les mots tapées qq soit nom complet ou qq lettres
        //keywords est le nom du champ search dans le topbar du site
        //name est un champ de la bd
        $products = Product::where('name', 'LIKE', '%' . $request->keywords . '%')->get();

        //récupération de la liste des catégories
        $categories = Category::all();

        return view('guest.shop')->with('categories', $categories)->with('products', $products);
    }
    

}
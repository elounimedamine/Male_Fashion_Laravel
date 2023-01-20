<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    //pour recupérer tous les données et les afficher dans un tableau
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    //Ajout de la catégorie
    //Reaquest qui contient les données du formulaire
    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        //redirection vers la page elle meme
        return redirect()->back();
        // return redirect()->back()->withErrors($request)->withInput();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    //pour recupérer tous les données et les afficher dans un tableau
    //index() => fonction qui permet d'afficher la liste des catégories
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    //store(Request $request) => fonction qui permet d'ajouter une catégorie
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

        if($category->save()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur d'ajout de la catégorie";
        }

        
    }

    //destroy($id) => supprimer une catégorie selon leur id
    public function destroy($id){
        $categorie = Category::find($id);

        if($categorie->delete()){
            //redirection vers la page elle meme
            return redirect()->back();
        }else{
            echo "Erreur de suppression de la catégorie";
        }
    }

    //update() => permet de modifier la catégorie
    public function update(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        //récupérer l'id du formulaire
        $id = $request->id_category;

        //chercher la catégorie selon leur id
        $category = Category::find($id);

        //ajouter des nouveaux informations
        $category->name = $request->name;
        $category->description = $request->description;

        if($category->update()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur de modification de la catégorie";
        }

    }


}

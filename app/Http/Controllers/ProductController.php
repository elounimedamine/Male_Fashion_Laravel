<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    //pour recupérer tous les données et les afficher dans un tableau
    //index() => fonction qui permet d'afficher la liste des produits
    public function index(){
        $products = Product::all();
        return view('admin.produits.index')->with('products', $products);
    }

    //store(Request $request) => fonction qui permet d'ajouter une catégorie
    //Ajout de la catégorie
    //Reaquest qui contient les données du formulaire
    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'qte' => 'required',
            'photo' => 'required',
        ]);

        //photo du formulaire
        //pour afficher la liste des informations du photo
        //dd($request, $request->file('photo'));

        //pour afficher les informations telque le path du photo
        $image = $request->file('photo'); 
        //echo $image; //C:\Users\medam\AppData\Local\Temp\php3BB2.tmp

        //pour afficher l'extension de l'image
        $image_extension = $image->getClientOriginalExtension();
        //echo $image_extension; //png

        //pour afficher le nom de l'image
        $image_name = $image->getClientOriginalName();
        //echo $image_name; //456212.png
 
        //pour afficher la taille de l'image en octets
        $image_size = $image->getSize();
        //echo $image_size; //9600 octets

        //Upload de l'image
        //Création de dossier nommée uploads dans lequel contient les images uploadée
        $destinationPath = 'uploads';
        //diriger l'image vers le dossier uploads
        $image_move = $image->move($destinationPath, $image_name); 
        //echo $image_move; //uploads\456212.png

        /*$product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte = $request->qte;
        $product->photo = $request->photo;

        if($product->save()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur d'ajout de produit";
        }*/

    }

    //destroy($id) => supprimer un produit selon leur id
    public function destroy($id){
        $product = Product::find($id);

        if($product->delete()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur de suppression de produit";
        }
    }

    //update() => permet de modifier le produit
    public function update(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'qte' => 'required',
            'photo' => 'required',
        ]);

        //récupérer l'id du formulaire
        $id = $request->id_product;

        //chercher le produit selon leur id
        $product = Product::find($id);

        //ajouter des nouveaux informations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte = $request->qte;
        $product->photo = $request->photo;

        if($product->update()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur de modification de produit";
        }

    }

    

}

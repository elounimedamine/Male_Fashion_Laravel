<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    //pour recupérer tous les données et les afficher dans un tableau
    //index() => fonction qui permet d'afficher la liste des produits et catégories
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('admin.produits.index')->with('categories', $categories)->with('products', $products);
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

        $product = new Product();

        $product->name = $request->name;

        //foreign key ml base = ml formulaire
        $product->category_id = $request->categorie;

        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte = $request->qte;

        //photo du formulaire
        //pour afficher la liste des informations du photo
        //dd($request, $request->file('photo'));

        //pour récupérer afficher les informations telque le path du photo
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
        // uniqid() => permet de définir un id aléatoire pour l'image : exp => 4567kji
        $newname = uniqid(); 

        //concaténer newname avec l'extension de l'image : exp => 4567kji.png
        $newname .= "." . $image_extension; 
        //echo $newname;

        //Création de dossier nommée uploads dans lequel contient les images uploadée
        $destinationPath = 'uploads';

        //diriger l'image avec son nouvea nom générée $newname vers le dossier uploads définit dans la variable $destinationPath 
        //$image_move = $image->move($destinationPath, $image_name); 
        $image_move = $image->move($destinationPath, $newname); 
        //echo $image_move; //uploads\456212.png

        // elle prend le nouveau nom $newname
        $product->photo = $newname;
        

        if($product->save()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur d'ajout de produit";
        }

    }

    //update() => permet de modifier le produit
    public function update(Request $request){

        //récupérer l'id du formulaire
        $id = $request->id_product;

        //chercher le produit selon leur id
        $product = Product::find($id);

        //ajouter des nouveaux informations
        $product->name = $request->name;

        //foreign key ml base = ml formulaire
        $product->category_id = $request->categorie;

        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte = $request->qte;

        //Upload Image

        // vérifier s'il y a une photo
        if($request->file('photo')){

            //s'il y a une ancienne photo, on va supprimer cette ancienne photo

            //public_path utilisée pour prendre le chemin du dossier public 
            //$file_path = Public//uploads/nom_image 
            $file_path = public_path() . '/uploads/' . $product->photo; 

            //dd($file_path); //=> "C:\laragon\www\malefashion\public/uploads/63cc946344bf7.png"

            //unlink() => permet de supprimer un fichier par l'attribution du chemain de localisation de la photo située dans la variable $file_path et les supprimer de la racine tq word, pdf etc
            //unlink(): http does not allow unlinking
            //il faut accéder au document sans http
            unlink($file_path);

            //Ajout de nouvelle photo

            //photo du formulaire
            //pour afficher la liste des informations du photo
            //dd($request, $request->file('photo'));

            //pour récupérer afficher les informations telque le path du photo
            $image = $request->file('photo'); 
            //echo $image; //C:\Users\medam\AppData\Local\Temp\php3BB2.tmp

            //pour afficher l'extension de l'image
            $image_extension = $image->getClientOriginalExtension();
            //echo $image_extension; //png

            //Upload de l'image
            // uniqid() => permet de définir un id aléatoire pour l'image : exp => 4567kji
            $newname = uniqid(); 

            //concaténer newname avec l'extension de l'image : exp => 4567kji.png
            $newname .= "." . $image_extension; 
            //echo $newname;

            //Création de dossier nommée uploads dans lequel contient les images uploadée
            $destinationPath = 'uploads';

            //diriger l'image avec son nouvea nom générée $newname vers le dossier uploads définit dans la variable $destinationPath 
            //$image_move = $image->move($destinationPath, $image_name); 
            $image_move = $image->move($destinationPath, $newname); 
            //echo $image_move; //uploads\456212.png

            // elle prend le nouveau nom $newname
            $product->photo = $newname;

        }

        if($product->update()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur de modification de produit";
        }

    }

    //destroy($id) => supprimer un produit selon leur id
    public function destroy($id){

        $product = Product::find($id);

        //public_path utilisée pour prendre le chemin du dossier public 
        //$file_path = Public//uploads/nom_image 
        $file_path = public_path() . '/uploads/' . $product->photo; 

        //dd($file_path); //=> "C:\laragon\www\malefashion\public/uploads/63cc946344bf7.png"

        //unlink() => permet de supprimer un fichier par l'attribution du chemain de localisation de la photo située dans la variable $file_path et les supprimer de la racine tq word, pdf etc
        //unlink(): http does not allow unlinking
        //il faut accéder au document sans http
        unlink($file_path);

        if($product->delete()){
            //redirection vers la page elle meme
            return redirect()->back();
            // return redirect()->back()->withErrors($request)->withInput();
        }else{
            echo "Erreur de suppression de produit";
        }
    }

    //fonction qui permet de rechercher un produit du formulaire($request)
    public function searchProduct(Request $request){
        //dd($request);

       //$products = Product::where('name', 'LIKE', '%'. $request->product_name .'%')->get();

       //4 cas
       if($request->product_name && !$request->qte){
            $products = Product::where('name', 'LIKE', '%'. $request->product_name .'%')->get();
       }

       if(!$request->product_name && $request->qte){
            $products = Product::where('qte', '>=', $request->qte)->get();
       }

       if($request->product_name && $request->qte){
            $products = Product::where('name', 'LIKE', '%'. $request->product_name .'%')->where('qte', '>=', $request->qte)->get();
       }

       if(!$request->product_name && !$request->qte){

            //retourner la liste de tous les produits
            $products = Product::all();
       }

       //récupération de la liste des catégories
       $categories = Category::all();

       return view('admin.produits.index')->with('products', $products)->with('categories', $categories);
    }


}

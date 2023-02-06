<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commande;
use App\Models\Review;
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

    //fonction qui permet d'ajouter un review
    public function addReview(Request $request){
        //dd($request);


        //création d'une instance de la classe review
         $review = new Review();

         //ajout d'un review
        $review->rate = $request->rate;
        $review->product_id = $request->product_id; // clé étrangère, product_id est un champ caché dans le html
        $review->content = $request->content;
        $review->user_id = Auth::user()->id; //current user connectée à travers son id, clé étrangère

        //enregistrer les données
        $review->save();

        //redirection vers dernière 1ere page 
        return redirect()->back();

    }

    //fonction qui permet de gérer la carte
    public function cart(){
        //récupération de la liste des categories
        $categories = Category::all();

        //vérifier si une commande est en cours pour ce client connectée et les récupérer
        $commande = Commande::where('client_id', Auth::user()->id)->where('etat', 'en cours')->first();

        return view('guest.cart')->with('categories', $categories)->with('commande', $commande);
    }

    //fonction qui permet de faire le checkout d'une commande
    public function checkout(Request $request){
        //dd($request);

        //avec l'id de commande nommée commande dans une input hidden du formulaire
        $commande = Commande::find($request->commande); //commande est le nom de champ hidden dans le formulaire pour avoir l'id du commande
        //dd($commande, $commande->getTotal());

        //changement d'etat de commande de en cours vers payée
        $commande->etat = "payée";

        //mise à jour
        $commande->update();

        return redirect('/client/dashboard')->with('success', 'Commande payée avec succèss');

    }

    //fonctions pour afficher la page de la liste des commandes de client
    public function mescommandes(){
        return view('client.commandes');
    }

    //fonctions pour afficher la page de bloquage de client
    public function AfficheMessageBloquee(){
        return view('client.bloquer');
    }


}

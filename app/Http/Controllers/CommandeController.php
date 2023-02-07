<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    //

    //fonction qui permet d'ajouter un produit dans le panier
    public function store(Request $request){
        //dd($request);

        //vérifier si une commande est en cours pour ce client
        $commande = Commande::where('client_id', Auth::user()->id)->where('etat', 'en cours')->first();

        //dd($commande);

        //partie création de commande
        //s'il y a un produit commandée en 1ere lieu(commande en cours existe), on va créer une nouvelle ligne de commande
        if($commande){

            //check if produit existe
            //supposons que le produit n'existe pas dans la ligne de commande
            $existe = false;
            
            foreach ($commande->lignecommandes as $lingec){

                if($lingec->product_id == $request->idproduct){
                    $existe = true;

                    $lingec->qte += $request->qte;

                    $lingec->update();
                }
            }

            //if existe = false, on va créer une nouvelle ligne de commande
            if(!$existe){
                //création de la ligne de commande
                $lc = new LigneCommande();
                $lc->qte = $request->qte;
                $lc->product_id = $request->idproduct; //id du champ cachetée
                $lc->commande_id = $commande->id; //id du commande crée en haut
                $lc->save();
                echo "produit commandée";
            }

            //redirection vers le panier
            return redirect('/client/cart')->with('success', 'Produit commandée');

        }else{
            //s'il n'y a pas de produit commandée en 1ere lieu(commande en cours n'existe pas), on va créer une nouvelle commande 
            $commande = new Commande();

            //l'etat n'a pas rien ca reste en cours, just le client_id en va le remplir
            $commande->client_id = Auth::user()->id; //current user

            if($commande->save()){
                //création de la ligne de commande
                $lc = new LigneCommande();
                $lc->qte = $request->qte;
                $lc->product_id = $request->idproduct; //du champ cachetée
                $lc->commande_id = $commande->id; //id du commande crée en haut
                $lc->save();
                //echo "produit commandée";

                //redirection vers le panier
                return redirect('/client/cart')->with('success', 'Produit commandée');

            }else{
                //pour redirect()->back() retourner au meme page
                return redirect()->back()->with('error', 'Impossible de commander le produit');
            }

        }

    }

    //fonction qui permet de supprimer une ligne de commande
    public function lignecommandeDestroy($idlc){

        $lc = LigneCommande::find($idlc);
        
        $lc->delete();

        //pour redirect()->back() retourner au meme page
        return redirect()->back()->with('success', 'Ligne de commande supprimée avec succèss');
    }

}

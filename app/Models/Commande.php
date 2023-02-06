<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    //Table Fille
    //Relation entre Commande et Client(user) (1 ... n)
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    //Table Mère
    //Relation entre Commande et LigneCommande (1 ... n)
    //commande contient 1 ou n ligne de commandes
    public function lignecommandes(){
        return $this->hasMany(LigneCommande::class, 'commande_id', 'id');
    }

    //fonction qui permet de retourner le total de la carte de commande de client
    public function getTotal(){
        //supposons que le totale = 0;
        $total = 0;

        //lignecommandes est de la reltion
        foreach($this->lignecommandes as $lc){
            $total += $lc->product->price * $lc->qte;
        }

        return $total;
    }


}
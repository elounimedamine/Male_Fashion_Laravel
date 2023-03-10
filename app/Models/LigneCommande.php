<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;

    //Table Fille
    //Relation entre Commande et LigneCommande (1 ... n)
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id', 'id');
    }

    //Table Fille
    //Relation entre LigneCommande et Produit (1 ... 1)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}

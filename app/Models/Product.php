<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //Table Fille
    //Relation entre Produit et Catégorie (1 ... 1)
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


}

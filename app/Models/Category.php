<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Table Mère
    //Relation entre Categorie et produits (0,1 ... n)
    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

}

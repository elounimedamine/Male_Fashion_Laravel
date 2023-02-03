<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    //Table Fille
    //Relation entre Review et User (1 ... n)
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //Table Fille
    //Relation entre Review et Product (1 ... n)
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}

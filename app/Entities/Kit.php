<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    //
  
    public function products()
    {
        return $this->belongsToMany(Product::class, 'kitsproducts');
    }

    

    public function getPrice(){

        

        return $this->products()->sum('price');
        //)

    }
}

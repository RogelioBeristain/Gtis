<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    //
    protected $guarded  = ['_token'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

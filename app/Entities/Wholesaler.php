<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Wholesaler extends Model
{
    //
    protected $guarded  = ['_token'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function wholesalercontacts()
    {
        return $this->hasMany(Wholesalercontact::class);
    }
}

<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //
    
    protected $fillable = [
        'description', 'price','model','cost','utility','code','shipping',
    ];




    public static  function findCode($code){
        
        return $products = DB::table('products')->where( 'model','LIKE','%'.$code.'%' )->get();
    
    }
    public function kits()
    {
        return $this->belongsToMany(Kit::class,'kitsproducts');
    }



    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
    public function wholesaler()
    {
        return $this->belongsTo(Wholesaler::class);
    }

}

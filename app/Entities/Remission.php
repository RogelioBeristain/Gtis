<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Remission extends Model
{
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'remission_products')->withPivot('quantity', 'shipping','total','discount','price','utility' );

        
    }
    public function kits()
    {
        return $this->belongsToMany(Kit::class, 'remission_kits') ->withPivot('quantity', 'shipping','total','discount','price','utility');
    }

    public static function lastRate(){
        return DB::table('remissions')->latest()->first();
        

    }
}

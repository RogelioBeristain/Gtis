<?php

use Illuminate\Database\Seeder;
use App\Entities\Product;
use App\Entities\Kit;
use App\Entities\Wholesaler;
use App\Entities\Manufacturer;


class CreateProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for ($i=5; $i <10 ; $i++) { 
            $product = new Product();
            $product->article= "prueba"+$i;//1
            $product->description = "prueba"+$i;
            $product->partnumber= "prueba"+$i;
            $product->code = "prueba"+$i;
            $product->model = "prueba"+$i;
            $product->manufacturer_id=1;
            $product->wholesaler_id=1;
            $product->stock=1;
            $product->cost = 100;
            $product->shipping =300; //10
        
            $product->price = $product->shipping + $product->cost;
            
            $wholesaler=Wholesaler::find($product->wholesaler_id);
            $manufacturer=Manufacturer::find($product->manufacturer_id);
        
          //  dd($product->manufacturer_id);
     
            $product->save();
           $wholesaler->products()->save($product);
    
            $manufacturer->products()->save($product);
        }
        
       
    }
}

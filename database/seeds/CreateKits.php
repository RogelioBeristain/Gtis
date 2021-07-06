<?php

use Illuminate\Database\Seeder;
use App\Entities\Product;
use App\Entities\Kit;
use App\Entities\Wholesaler;
use App\Entities\Manufacturer;


class CreateKits extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for ($i=1; $i <10 ; $i++) { 
            $kit = new Kit();
 
        $kit->description ="kitprueba"+$i;//1
        
        $kit->title = "kitprueba"+$i;
        
        $kit->price = "kitprueba"+$i;
    
        $kit->save();
            for ($i=5; $i <10 ; $i++) { 

                $kit->products()->attach([ $i ] );
           
        }

     
        }
        
       
    }
}

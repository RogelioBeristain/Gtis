<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitsproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitsproducts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('kit_id');

            $table->unsignedBigInteger('product_id');
        
            $table->foreign('kit_id')->references('id')->on('kits')->onDelete('cascade');
        
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kitsproducts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description')->nullable();
            $table->string('model')->nullable();
            $table->string('code')->nullable();
            $table->decimal('price',20,4)->nullable();
            $table->decimal('cost',20,4)->nullable();
            $table->decimal('utility',20,4)->nullable();
            $table->string('stock') ->default(0)->nullable();
            $table->decimal('shipping',20,4)->nullable();
            $table->unsignedBigInteger('wholesaler_id') ->nullable()->unsigned();
            $table->unsignedBigInteger('manufacturer_id')->nullable()->unsigned();
            $table->text('article')->nullable();
            $table->string('partnumber')->nullable();
            $table->string('url_image')->nullable();
    
        
          // $table->foreign('wholesaler_id')->references('id')->on('wholesalers')->onDelete('cascade');
          // $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
      
       
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
        Schema::dropIfExists('products');
    }
}
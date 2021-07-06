<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratesproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rate_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price',20,4)->nullable();
            $table->decimal('utility',20,4)->nullable();
            $table->decimal('shipping',20,4)->nullable();
            $table->decimal('discount',20,4)->nullable();
            $table->decimal('total',20,4)->nullable();
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');
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
        Schema::dropIfExists('ratesproducts');
    }
}

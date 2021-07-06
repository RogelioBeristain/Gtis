<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemissionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remission_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('remission_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price',20,2)->nullable();
            $table->decimal('utility',20,2)->nullable();
            $table->decimal('shipping',20,2)->nullable();
            $table->decimal('discount',20,2)->nullable();
            $table->decimal('total',20,2)->nullable();
            $table->foreign('remission_id')->references('id')->on('remissions')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remission_products', function (Blueprint $table) {
      /*   $table->dropForeign(['remission_id']);
        $table->dropColumn('remission_id');
        $table->dropForeign(['product_id']);
        $table->dropColumn('product_id'); */
        Schema::dropIfExists('remission_products');
        });
    }
}

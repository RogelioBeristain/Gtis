<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateskitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rateskits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rate_id');
            $table->unsignedBigInteger('kit_id');
            $table->unsignedInteger('quantity')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price',20,4)->nullable();
            $table->decimal('utility',20,4)->nullable();
            $table->decimal('shipping',20,4)->nullable();
            $table->decimal('discount',20,4)->nullable();
            $table->decimal('total',20,4)->nullable();
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');
            $table->foreign('kit_id')->references('id')->on('kits')->onDelete('cascade');
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
        Schema::dropIfExists('rateskits');
    }
}

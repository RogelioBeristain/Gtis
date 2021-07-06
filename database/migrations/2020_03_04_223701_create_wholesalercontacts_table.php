<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWholesalercontactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wholesalercontacts', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('wholesaler_id');
            $table->foreign('wholesaler_id')->references('id')->on('wholesalers')->onDelete('cascade');
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
        
        Schema::dropIfExists('wholesalercontacts');
    }
}

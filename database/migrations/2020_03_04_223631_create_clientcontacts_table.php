<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientcontactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientcontacts', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('client_id');
           $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
           
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
    

        Schema::dropIfExists('clientcontacts');
      
    }
}

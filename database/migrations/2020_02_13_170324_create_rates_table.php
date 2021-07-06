<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('place_delivery')->nullable();//lugar de entrega

            $table->string('time_delivery')->nullable();//fecha de entrega
            
            $table->string('time_price')->nullable();//null

            $table->string('guarantee')->nullable();
           
            $table->string('pay_mode')->nullable();
            $table->string('type_currency')->nullable();

            $table->unsignedBigInteger('ratenumber')->nullable();//numero 
            $table->unsignedBigInteger('client_id')->nullable();//datos cliente
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('validation')->nullable();
            $table->decimal('total',20,4)->nullable(); // total
            $table->string('pdf')->nullable();
             $table->string('user_prefix')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}

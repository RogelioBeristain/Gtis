<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('place_delivery')->nullable();//lugar de entrega

            $table->string('time_delivery')->nullable();//fecha de entrega
    

            $table->unsignedBigInteger('remission_number')->nullable();//numero 
            $table->unsignedBigInteger('client_id')->nullable();//datos cliente
            $table->unsignedBigInteger('user_id')->nullable();// personal
        
            $table->decimal('total',20,2)->nullable(); // total
            $table->string('pdf')->nullable();
            $table->string('user_prefix')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('remissions', function (Blueprint $table) {
          /*   $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id'); */
            Schema::dropIfExists('remissions');
        });


    }
}

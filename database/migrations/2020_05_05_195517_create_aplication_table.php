<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplications', function (Blueprint $table) {
            $table->id();
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('number_aux')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->text('body')->nullable();
            
            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('set null');
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
        Schema::dropIfExists('aplications');
    }
}

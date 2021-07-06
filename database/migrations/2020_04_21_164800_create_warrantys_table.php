<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('tel_number')->nullable();
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->text('description')->nullable();
            $table->string('model')->nullable();
            $table->string('code')->nullable();
            $table->string('serial_number');
            $table->date('date_pay')->nullable();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('set null');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warranties');
    }
}

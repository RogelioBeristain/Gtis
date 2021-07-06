<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTelToAplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aplications', function (Blueprint $table) {
            $table->string('tel_number')->nullable();
            $table->boolean('visible')->nullable()->default(true);
            $table->text('respuesta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aplications', function (Blueprint $table) {
            $table->dropColumn('tel_number');
            $table->dropColumn('visible');
            $table->dropColumn('respuesta');
        });
    }
}

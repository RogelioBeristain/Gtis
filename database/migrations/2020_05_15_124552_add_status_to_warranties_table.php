<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warranties', function (Blueprint $table) {
            //
            $table->boolean('status')->nullable()->default(false);
            $table->boolean('visible')->nullable()->default(true);
            $table->json('files')->nullable();
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
        Schema::table('warranties', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('visible');
            $table->dropColumn('files');
            $table->dropColumn('respuesta');
        });
    }
}

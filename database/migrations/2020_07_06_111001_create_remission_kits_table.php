<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemissionKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remission_kits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('remission_id');
            $table->unsignedBigInteger('kit_id');
            $table->unsignedInteger('quantity')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price',20,2)->nullable();
            $table->decimal('utility',20,2)->nullable();
            $table->decimal('shipping',20,2)->nullable();
            $table->decimal('discount',20,2)->nullable();
            $table->decimal('total',20,2)->nullable();
            $table->foreign('remission_id')->references('id')->on('remissions')->onDelete('cascade');
            $table->foreign('kit_id')->references('id')->on('kits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remission_kits', function (Blueprint $table) {
     /*    $table->dropForeign(['remission_id']);
        $table->dropColumn('remission_id');
        $table->dropForeign(['kit_id']);
        $table->dropColumn('kit_id'); */
        Schema::dropIfExists('remission_kits');
        });
    }
}

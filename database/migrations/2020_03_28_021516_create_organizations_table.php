<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');

            
            $table->string('name')->nullable()->default(" ");
            $table->string('address')->nullable()->default(" ");
            $table->string('city')->nullable()->default(" ");
            $table->string('tel1')->nullable()->default(" ");
            $table->string('skype')->nullable()->default(" ");
            $table->string('url_logo')->nullable()->default(" ");
            $table->string('banks')->nullable()->default(" ");
            $table->string('name_social')->nullable()->default(" ");
            $table->string('zip')->nullable()->default(" ");
            $table->string('email')->nullable()->default(" ");
            $table->string('tel2')->nullable()->default(" ");
            $table->string('color')->nullable()->default(" ");
            $table->string('url_page')->nullable()->default(" ");
            $table->string('url_marcas')->nullable()->default(" ");

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
        Schema::dropIfExists('organizations');
    }
}

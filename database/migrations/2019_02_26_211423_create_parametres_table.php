<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_etablissement', 255)->nullable();
            $table->string('adr_etablissement', 255)->nullable();
            $table->string('tel1_etablissement', 20)->nullable();
            $table->string('tel2_etablissement', 20)->nullable();
            $table->string('fax_etablissement', 20)->nullable();
            $table->string('site_etablissement', 20)->nullable();

            $table->unsignedInteger('medecin_defaut')->nullable();
            $table->foreign('medecin_defaut')->references('id')->on('medecins');

            $table->unsignedInteger('user_created')->nullable();
            $table->foreign('user_created')->references('id')->on('users');
            $table->unsignedInteger('user_modified')->nullable();
            $table->foreign('user_modified')->references('id')->on('users');

            $table->softDeletes();
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
        Schema::dropIfExists('parametres');
    }
}

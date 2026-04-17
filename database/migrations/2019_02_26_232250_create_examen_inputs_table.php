<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_inputs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle', 50)->nullable();
            $table->string('unite', 10)->nullable();
            $table->string('categorie', 50)->nullable();
            $table->unsignedInteger('ordre')->nullable();
            $table->unsignedInteger('examen_modele_id')->nullable();

            $table->unsignedInteger('user_created')->nullable();
            $table->unsignedInteger('user_modified')->nullable();

            $table->foreign('examen_modele_id')->references('id')->on('examen_modeles');
            $table->foreign('user_created')->references('id')->on('users');
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
        Schema::dropIfExists('examen_inputs');
    }
}

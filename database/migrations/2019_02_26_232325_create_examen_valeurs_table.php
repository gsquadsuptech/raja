<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenValeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_valeurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valeur', 10)->nullable();
            $table->unsignedInteger('examen_id')->nullable();
            $table->unsignedInteger('examen_input_id')->nullable();

            $table->unsignedInteger('user_created')->nullable();
            $table->unsignedInteger('user_modified')->nullable();

            $table->foreign('examen_id')->references('id')->on('examens');
            $table->foreign('examen_input_id')->references('id')->on('examen_inputs');
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
        Schema::dropIfExists('examen_valeurs');
    }
}

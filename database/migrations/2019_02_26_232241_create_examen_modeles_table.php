<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenModelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_modeles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_examen', 50)->nullable();
            $table->unsignedInteger('type_examen_id')->nullable();

            $table->unsignedInteger('user_created')->nullable();
            $table->unsignedInteger('user_modified')->nullable();

            $table->foreign('type_examen_id')->references('id')->on('type_examens');
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
        Schema::dropIfExists('examen_modeles');
    }
}

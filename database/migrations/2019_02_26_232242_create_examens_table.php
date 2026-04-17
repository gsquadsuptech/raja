<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document', 255)->nullable();
            $table->unsignedInteger('consultation_id')->nullable();
            $table->unsignedInteger('examen_modele_id')->nullable();
            $table->text('commentaires')->nullable();
            $table->text('conclusions')->nullable();

            $table->unsignedInteger('user_created')->nullable();
            $table->unsignedInteger('user_modified')->nullable();

            $table->foreign('consultation_id')->references('id')->on('consultations');
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
        Schema::dropIfExists('examens');
    }
}

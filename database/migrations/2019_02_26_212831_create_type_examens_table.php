<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_examens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_examen_nom', 50)->nullable();
            $table->unsignedInteger('user_created')->nullable();
            $table->unsignedInteger('user_modified')->nullable();
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
        Schema::dropIfExists('type_examens');
    }
}

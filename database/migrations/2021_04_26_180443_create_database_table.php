<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('imgpath', 255)->nullable();
            $table->string('firstname', 45);
            $table->string('lastname', 45);
            $table->string('note', 90);
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name', 45);
        });

        Schema::create('producers', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name', 45);
            $table->string('email', 64)->unique();
        });

        Schema::create('movies', function ($table) {
            $table->Increments('id');
            $table->string('imgpath', 255)->nullable();
            $table->string('title', 45);
            $table->string('description', 255);
            $table->date('release');
            $table->integer('genre_id')->unsigned();
            $table->integer('producer_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name', 45);
            $table->integer('actor_id')->unsigned();
            $table->integer('movie_id')->unsigned();
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actors');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('movies');
        Schema::dropIfExists('producers');
        Schema::dropIfExists('roles');
    }
}

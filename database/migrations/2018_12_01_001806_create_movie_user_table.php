<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieUserTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::create('movie_user', function (Blueprint $table) {
$table->integer('movie_id')->unsigned()->index();
//$table->foreign('movie_id')->references('id')->on('movie')->onDelete('cascade');
$table->integer('user_id')->unsigned()->index();
//$table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
$table->primary(['movie_id', 'user_id']);
});
Schema::table('movie_user', function($table) {
    $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
}

/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::dropIfExists('movie_user');
}
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::create('movies', function (Blueprint $table) {
$table->increments('id');
$table->string('name')->unique();
$table->text('description');
$table->string('releaseDate');
$table->string('genre');
$table->string('image');
$table->integer('numberOfRating')->default(0);
$table->decimal('rate')->default(0);
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
Schema::drop('movies');
}
}

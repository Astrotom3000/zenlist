<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->longText('description', 255);
			$table->string('release_date', 15);
			$table->string('poster_path', 255);
			$table->string('tagline', 255);
			$table->smallInteger('year');
			$table->integer('tmdb_id');
			$table->string('imdb_id');
			$table->string('rottentomatoes_id');

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
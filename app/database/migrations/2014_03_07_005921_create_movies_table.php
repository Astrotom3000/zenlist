<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('movies', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('tmdb_id')->unique();
			$table->integer('rottentomatoes_id')->unique();
			$table->integer('imdb_id')->unique();
			$table->string('title');
			$table->smallinteger('year');
			$table->date('release_date');
			$table->integer('critics_rating');
			$table->integer('audience_rating');
			$table->integer('runtime');
			$table->string('genre');
			$table->string ('poster_path');
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

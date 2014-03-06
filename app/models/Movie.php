<?php

class Movie extends Eloquent {

	protected $table = 'movies';

	public function getMovieId()
	{
		return $this->id;
	}

	public function getTMDBId()
	{
		return $this->tmdb_id;
	}

	public function getMovieTitle()
	{
		return $this->title;
	}

}

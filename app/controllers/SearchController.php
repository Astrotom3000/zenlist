<?php

class SearchController extends BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function store()
	{
		
		$search = Input::get('searchterm');

		$token  = new \Tmdb\ApiToken('ca85ff10880b1490989e8dbeb5932c00');
    	$client = new \Tmdb\Client($token);
    	$repository = new \Tmdb\Repository\MovieRepository($client);

		$searchMovies = $client->getSearchApi()->searchMovies($search);

		for ($i=0; $i < count($searchMovies['results']); $i++)
		{
			$movieID = $searchMovies['results'][$i]['id'];
			$searchID = DB::table('movies')->where('tmdb_id', $movieID)->pluck('tmdb_id');

		if (is_null($searchID))
			{
				$newMovie = $client->getMoviesApi()->getMovie($movieID);

				$movie = new Movie;
				$movie->title = $newMovie['title'];
				$movie->tmdb_id = $newMovie['id'];
				$movie->rottentomatoes_id = null;
				$movie->imdb_id = null;
				$movie->year = null;
				$movie->release_date = $newMovie['release_date'];
				$movie->critics_rating = null;
				$movie->audience_rating = $newMovie['vote_average'];
				$movie->runtime = $newMovie['runtime'];
				$movie->genre = null;
				$movie->poster_path = $newMovie['poster_path'];

				$movie->save();
			}
		}
		
		//return var_dump($searchMovies);
		return var_dump($searchMovies);
		//return View::make('searchresults')->with('results', $result);
	}

}

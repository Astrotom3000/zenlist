<?php

class SearchController extends BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function store()
	{
		//Get input
		$search = Input::get('searchterm');

		//Setup client
		$token  = new \Tmdb\ApiToken('ca85ff10880b1490989e8dbeb5932c00');
    	$client = new \Tmdb\Client($token);
   	
    	if($search == '')
    	{
    		//If user enters no search word, return them to explore page with message
    		return View::make('explore')->with('flash_message', 'Please enter a word or phrase in the search box!');
    	}
    	else
    	{
    		//Get number of pages from search results
    		$moviePagesTemp = $result = $client->getSearchApi()->searchMovies($search);
    		$moviePages = $moviePagesTemp['total_pages'];

    		$resultsArray = [];
    		$resultsArray['movies'] = [];
    		$resultsArray['tv'] = [];
    		$resultsArray['people'] = [];
    		
    		for($i = 1; $i <= $moviePages; $i++)
    		{
    			$query = new \Tmdb\Model\Search\SearchQuery\MovieSearchQuery();
				$query->page($i);

				$repository = new \Tmdb\Repository\SearchRepository($client);	
				$findMovies = $repository->searchMovie($search, $query);

				$findMoviesTemp = $findMovies->toArray();

				$moviePage = [];

				foreach($findMoviesTemp as $movieT)
				{
					$movieOb = [];
					$movieOb['id'] = $movieT->getId();
					$movieOb['title'] = $movieT->getTitle();
					$movieOb['posterpath'] = $movieT->getPosterPath();
					$movieOb['release'] = $movieT->getReleaseDate()->format('M j, Y');
					array_push($moviePage, $movieOb);
				}

				array_push($resultsArray['movies'], $moviePage);
    		}
    		
    		return View::make('searchresults')->with('results', $resultsArray);
    		//return var_dump($resultsArray);
    	}
	}
}

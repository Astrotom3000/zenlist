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
		return View::make('searchresults')->with('searchword', $search);
	}

}

@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
		<!--<h4>Search term: <strong>{{ $searchword }}</strong></h4>-->
		{{ Form::open() }}
			{{ Form::hidden('searchphrase', $searchword, array('id' => 'query')) }}
		{{ Form::close() }}

	<div class="container">
		<h3>Filter Results</h3>
		{{ Form::open() }}
		<div class="form-group input-form">
			{{ Form::label('filtermovies', 'Movies') }}
			{{ Form::checkbox('movies', '$filtermovies', true)}}
			<label class="field-icon fa fa-envelope"></label>
			{{ Form::label('filtershows', 'TV Shows') }}
			{{ Form::checkbox('shows', '$filtershows', true)}}
			<label class="field-icon fa fa-envelope"></label>
			{{ Form::label('filteractors', 'Actors') }}
			{{ Form::checkbox('actors', '$filteractors', true)}}
			<label class="field-icon fa fa-envelope"></label>
			{{ Form::label('filterdirectors', 'Directors') }}
			{{ Form::checkbox('directors', '$filterdirectors', true)}}
			<label class="field-icon fa fa-envelope"></label>
		</div>
		{{ Form::close() }}
	</div>
	<div class='row' id="display-results">
	</div>
	
	</div>
</div>
@endsection
<!--Request to grab our TMDB search results-->
@section('scripts')
<script>
	$(function() {
	    var query = $('input#query').val();
	    if(query.toLowerCase()=='movie'){
	    	$('#display-results').append('<div id="movie-results" class="col-md-5"><h1>Movies</h1></div>');
	    	$('#movie-results').append('<div id="movie">' + query +'</div>'); //display individual movie
	    }
	    else if(query.toLowerCase()  == 'tv')
	    {
	    	$('#display-results').append('<div id="tv-results" class="col-md-5"><h1>TV Shows</h1></div>');
	    	$('#tv-results').append('<div id="tvshow">' + query +'</div>');
	    }
	    else if(query.toLowerCase()  == 'full')
	    {
	    	$('#display-results').append('<div id="movie-results" class="col-md-5"><h1>Movies</h1></div>');
	    	$('#movie-results').append('<div id="movie">' + query +'</div>'); //display individual movie

	    	$('#display-results').append('<div id="tv-results" class="col-md-5"><h1>TV Shows</h1></div>');
	    	$('#tv-results').append('<div id="tvshow">' + query +'</div>');

	    	$('#display-results').append('<div id="people-results" class="col-md-5"><h1>People</h1></div>');
	    	$('#people-results').append('<div id="person">' + query +'</div>');
	    }

	    else{
	    	$('#display-results').append('<h1> No results found for: ' + query + '</h1>');
	    }
	   // $('#results a:last').tab('show');
	});
</script>
@endsection


@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
		<!--<h4>Search term: <strong>{{ $searchword }}</strong></h4>-->
		{{ Form::open() }}
			{{ Form::hidden('searchphrase', $searchword, array('id' => 'query')) }}
		{{ Form::close() }}
    <center><h2>Search Results</h2></center>
		<div id="results" class="col-md-7 col-md-offset-4">
				<ul class="result">
				</ul>	
  <ul class="pajinate"></ul>
			</div>	
	</div>
</div>
@endsection
<!--Request to grab our TMDB search results-->
@section( 'scripts' )

<script>
var api_key="ca85ff10880b1490989e8dbeb5932c00";
var resultsArray = [];

/*Starts off the query to TMDB for movies*/
$(document).ready(function(){
  var tmdb_movies="http://api.themoviedb.org/3/search/movie?query=";
  var query = $('input#query').val();
  if(query === ''){
    $('.result').append('<h3>No results found for emptiness.</h3>');
  }
  else{
    $.getJSON( tmdb_movies+query+'&api_key='+api_key+'&page=1', {
      format: "json"
    })
      .done(function( data ) {
        $.each( data.results, function( i, movie ) {
          resultsArray.push({'id': movie.id, 'title' : movie.original_title, 'release_date':movie.release_date, 'popularity' : movie.popularity, 'type':'film', 'overview': '', 'poster_path':movie.poster_path});
        }); //ends each loop
        TVsearch(query);
        console.log(resultsArray);
    }); //end getJSON
  }
});



/* Searches TMDB for tv shows */
function TVsearch(query){
  var tmdb_tv = "http://api.themoviedb.org/3/search/tv?query=" + query + '&api_key='+api_key;
  $.getJSON( tmdb_tv, {
    format: "json"
  })
  .done(function( data ) {
      $.each( data.results, function( i, show ) {
        resultsArray.push({'id': show.id, 'title' : show.name, 'release_date': show.first_air_date,'popularity' : show.popularity, 'type':'TV', 'overview': '','poster_path':show.poster_path});
      });
      resultsArray.sort(dynamicSort("popularity"));
      if(resultsArray.length >0){
        for(var i=0; i<resultsArray.length; i++){
          /*
          if(resultsArray[i].type == 'film'){
            resultsArray[i].overview = getMovieOverview(resultsArray[i].id); //adds the description for each movie
          }
          if(resultsArray[i].type == 'tv'){
            resultsArray[i].overview = getTVOverview(resultsArray[i].id); //adds the description for each movie
          }*/
          if(resultsArray[i].release_date !== null && resultsArray[i].release_date != '')
            $('.result').append('<li><h3>'+resultsArray[i].title+' ('+resultsArray[i].release_date.substr(0,4)+')</h3><p>' + resultsArray[i].overview+ '</p></li>');
          else
            $('.result').append('<li><h3>'+resultsArray[i].title+'</h3><p>' + resultsArray[i].overview+ '</p></li>');
        }
        $('#results').pajinate({
            items_per_page : 5,
            item_container_id : '.result',
	          nav_panel_id : '.pajinate'	
				});
      }
      else{
        $('.result').append('<h3>No results found for: <i>'+query+'</i></h3>');
      }
      
  });
}

/* Gets the description for specified movie synchronously */
function getMovieOverview(id) {
    var tmdb_movie = "http://api.themoviedb.org/3/movie/" + id + '?api_key='+api_key;
    var overview="";
    $.ajax({
      url:tmdb_movie,
      async: false,  
      success:function(movie) {
         overview = movie.overview; 
      }
   });
   return overview;
}

/*Get overview for TV Show */
function getTVOverview(id) {
    var tmdb_tv = "http://api.themoviedb.org/3/tv/" + id + '?api_key='+api_key;
    var overview="";
    $.ajax({
      url:tmdb_tv,
      async: false,  
      success:function(show) {
         overview = show.overview; 
      }
   });
   return overview;
}

/* Sorts the array of objects in descending order */
function dynamicSort(property) {
    var sortOrder = 1;Array[0]
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        var result = (a[property] > b[property]) ? -1 : (a[property] < b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}

/** Testing function to update the view
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
*/
</script>
@endsection


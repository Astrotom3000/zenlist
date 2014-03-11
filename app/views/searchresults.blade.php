@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
  
@include('layouts/partials/_flash_message')

  <div id="preloader"><img src="{{ URL::asset('assets/img/loader.gif') }}" width="50" height="50" alt=
"AJAX loader" title="AJAX loader" /></div>
		<!--<h4>Search term: <strong>{{ $searchword }}</strong></h4>-->
		{{ Form::open() }}
			{{ Form::hidden('searchphrase', $searchword, array('id' => 'query')) }}
		{{ Form::close() }}
    <div class="page-header align-center"></div>
		<div class="results">
			</div>	
	</div>
</div>
@endsection
<!--Request to grab our TMDB search results-->
@section( 'scripts' )

<script>
var tmdb_key="ca85ff10880b1490989e8dbeb5932c00";
var resultsArray = [];
var people = [];
var thumbnailpath = "http://d3gtl9l2a4fn1j.cloudfront.net/t/p/w92";
var noimg = "'none'";
var movieFound=0, tvFound=0, peopleFound=0;
var queryVal, queryStr = '';

//Starts off the query to TMDB for movies
$(function(){
  var tmdb_movies="http://api.themoviedb.org/3/search/movie?query=";
  queryVal = $('input#query').val();
  queryStr = queryVal.replace(/[_\W]+/g, " "); //nonword characters taken out
  var query = encodeURIComponent(queryStr);

  //var queryURI = encodeURI(tmdb_movies+query+'&api_key='+api_key+'&page=1');
  $('#preloader').show();
  if(!query){
      $('.page-header').append('<h3>Please enter a word or phrase to search.</h3>');
  }
  else{
    $.getJSON( tmdb_movies+query, {
      format: "json",
      api_key: tmdb_key,
      page: 1
    })
      .done(function( data ) {
        console.log(data);
        $.each( data.results, function( i, movie ) {
          var year = ' ';
           if(movie.release_date){
             var yeardate = movie.release_date.substr(0,4);
             year = '('+yeardate+')';
           }
          resultsArray.push({'id': movie.id, 'title' : movie.title, 'year':year, 
                            'popularity':movie.popularity, 'type':'movie','poster_path':movie.poster_path,
                            'directors':[], 'starring':[]});
          movieCreditsSearch(i, movie.id); //adds director and starring actors to the results
          if ( i === 8 ) {
            return false;
          }
        });
        TVsearch(query);
    });
  }
});

function movieCreditsSearch(index, id){
  var movieCredits = "http://api.themoviedb.org/3/movie/" + id + '/credits?api_key='+tmdb_key;
  var director = '', directorID;
    $.getJSON( movieCredits, {
    format: "json"
  })
    .done(function( data ) {
      try{
        for(var i in data.crew){
          if(data.crew[i].job =="Director"){
            director = data.crew[i].name;
            directorID = data.crew[i].id;
            resultsArray[index].directors.push({'id':directorID, 'name':director});
          }
        }
       // Store director and leading actors
       resultsArray[index].starring.push({'id':data.cast[0].id, 'name':data.cast[0].name});
       resultsArray[index].starring.push({'id':data.cast[1].id, 'name':data.cast[1].name});
       resultsArray[index].starring.push({'id':data.cast[2].id, 'name':data.cast[2].name});
      }
      catch(e){
       console.log('cast or crew not found.');
      }

    });
}

//Search for tv shows
function TVsearch(query){
  var tmdb_tv = "http://api.themoviedb.org/3/search/tv?query=" + query + '&api_key='+tmdb_key;
  $.getJSON( tmdb_tv, {
    format: "json"
  })
  .done(function( data ) {
      $.each( data.results, function( i, show ) {
         if(show.first_air_date){
           var year = show.first_air_date.substr(0,4);
           var yearParenths = '('+year+')';
           resultsArray.push({'id': show.id, 'title' : show.name, 'year':yearParenths,
                          'popularity':show.popularity, 'type':'show','poster_path':show.poster_path, 'starring':[] }); 
         }else{
            resultsArray.push({'id': show.id, 'title' : show.name, 'year': ' ',
                          'popularity':show.popularity, 'type':'show','poster_path':show.poster_path, 'starring':[] }); }
        if ( i === 8 ) {
          return false;
        }
      });
    //add TV credits
    for(var iter in resultsArray){
      if(resultsArray[iter].type == 'show')
          tvCreditsSearch(iter, resultsArray[iter].id); 
    }
    peopleSearch(query); //head off to the last query for people
  });
}

function tvCreditsSearch(index, id){
  var tvCredits = "http://api.themoviedb.org/3/tv/" + id + '/credits?api_key='+tmdb_key;
    $.getJSON( tvCredits, {
    format: "json"
  })
    .done(function( data ) {
      try{
       // Store leading actors
       resultsArray[index].starring.push({'id':data.cast[0].id, 'name':data.cast[0].name});
       resultsArray[index].starring.push({'id':data.cast[1].id, 'name':data.cast[1].name});
       resultsArray[index].starring.push({'id':data.cast[2].id, 'name':data.cast[2].name});
      }
      catch(e){
       console.log('some tv properties were undefined');
      }

    });
}

// Last asynchronous search, this is where we will build our output to the DOM
function peopleSearch(query){
  var tmdb_people = "http://api.themoviedb.org/3/search/person?query=" + query + '&api_key='+tmdb_key;
    $.getJSON( tmdb_people, {
    format: "json"
  })
  .done(function( data ) {
      $.each( data.results, function( i, person ) {
        if(person.profile_path)
        people.push({'id': person.id, 'name' : person.name, 'profile_path':person.profile_path});
      });
     resultsArray.sort(dynamicSort("popularity")); //sort movies and tv shows by popularity

      //Display the search results
      console.log(resultsArray);
    if(resultsArray.length ===0 && people.length===0){
      $('.page-header').append('<h3>No results found for: <i>'+queryStr+'</i></h3>');
    } else { 
      console.log(resultsArray);
      $('.page-header').append('<h3>Results found for: <i>'+queryVal+'</i></h3>');
      //display movies and tv shows first
      if(resultsArray.length>0){
        for(var i in resultsArray){
            var posterURL = thumbnailpath + resultsArray[i].poster_path;
            var title = resultsArray[i].title;
            var year = resultsArray[i].year;
            var id = resultsArray[i].id;
            if(resultsArray[i].type == 'show'){
              tvFound++;
              if(resultsArray[i].starring.length ==3){
                var tv_lead1 = resultsArray[i].starring[0].name;
                var tv_lead2 = resultsArray[i].starring[1].name;
                var tv_lead3 = resultsArray[i].starring[2].name;
                $('.results').append('<div id="tv" class="result-box"><img src="'+posterURL+'" onerror="this.style.display='+noimg+'"/><a href="#">'+title+'</a> ' + year
                + '<br>Starring: <a href="#">'+tv_lead1+'</a>, ' +'<a href="#">'+tv_lead2+'</a>, ' + '<a href="#">'+tv_lead3+'</a></div>');
              }
              else
                $('.results').append('<div id="tv" class="result-box"><img src="'+posterURL+'" onerror="this.style.display='+noimg+'"/><a href="#">'+title+'</a> ' + year +'</div>');
            } 
            if(resultsArray[i].type == 'movie'){
              movieFound++;
              if(resultsArray[i].starring.length == 3 && resultsArray[i].directors.length >0){
                var movie_lead1 = resultsArray[i].starring[0].name;
                var movie_lead2 = resultsArray[i].starring[1].name;
                var movie_lead3 = resultsArray[i].starring[2].name;
                var director1 = ' ', director2 = ' ', comma=' ';
                if(resultsArray[i].directors[0])
                    director1 = resultsArray[i].directors[0].name;
                if(resultsArray[i].directors[1]){
                    comma =', ';
                    director2 = resultsArray[i].directors[1].name;
                  }
                $('.results').append('<div id="movie" class="result-box"><img src="'+posterURL+'" onerror="this.style.display='+noimg+'"/><a href="#" class="movie"><span class="title">'+title+'</span><span class="id" style="display:none;">'+id+'</span></a> ' + year
                + '<br>Starring: <a href="#">'+movie_lead1+'</a>, ' +'<a href="#">'+movie_lead2+'</a>, ' + '<a href="#">'+movie_lead3+'</a><br>'
                + 'Directed by: ' + '<a href="#"> '+director1+'</a>'+comma+'<a href="#"> '+director2+'</a></div>');
              }
              else
                $('.results').append('<div id="movie" class="result-box"><img src="'+posterURL+'" onerror="this.style.display='+noimg+'"/><a href="#" class="movie"><span class="title">'+title+'</span><span class="id" style="display:none;">'+id+'</span></a> ' + year +'</div>');
            }
        } 
      }
      if(people.length>0){
        //display people results
        for(var j in people){
            var photo = thumbnailpath + people[j].profile_path;
            var person = people[j].name;
            var person_id = people[j].id;
            $('.results').append('<div class="result-box" id="people">' 
              + '<img src="' + photo + 'onerror="this.style.display='+ noimg + '" />'
              + '<a href="#">' + person + '</a></div>');
          }
      }
    }

    peopleFound = people.length; 
    if(movieFound>0){
      $('.page-header').append('<button id="movieButton" type="button" class="btn btn-default"><span class="glyphicon glyphicon-film"></span> Movies ('+ movieFound + ')</button>');
    }
    if(tvFound>0){
      $('.page-header').append('<button id="tvButton" type="button" class="btn btn-default"><span class="glyphicon glyphicon-laptop"></span> TV Shows ('+ tvFound + ')</button>');
    }
    if(peopleFound>0){
      $('.page-header').append('<button id="peopleButton" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> People ('+ peopleFound + ')</button>');
    }
    $('#preloader').hide();
    $( "#tvButton" ).click(function() {
         $("div#movie").hide();
         $("div#people").hide();
         $("div#tv").show();
    });
    $( "#movieButton" ).click(function() {
         $("div#tv").hide(); 
         $("div#people").hide();
         $("div#movie").show(); 
    });
    $( "#peopleButton" ).click(function() {
         $("div#tv").hide(); 
         $("div#movie").hide();
         $("div#people").show(); 
    });

    $("a.movie").click(function(){
      //var movie_title = $(this).children("span.title").text();
      var movie_id = $(this).children("span.id").text();
      window.location = 'movie/'+movie_id;
      //alert(movie_id);
      //var movie_titleURI = encodeURIComponent(movie_title);
      //var movieRoute= movie_id+ '/'+movie_titleURI;
      
    });

  });
}

// Sorts the array of objects in descending order
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



</script>
@endsection


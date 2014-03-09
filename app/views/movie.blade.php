@extends('layouts.default')

@section('content')
<div class="content">
<div class="container .movie-container">
<div class="flash-message alert alert-warning" style="display:none;"><h4> Please log in to do that :)</h4></div>

    <div id="preloader"><img src="{{ URL::asset('assets/img/loader.gif') }}" alt="AJAX loader" title="AJAX loader" /></div>
    <div class="movie-header" style="display:none;"><h2 class="title"><span class="year"></span></h2> 
<input type="hidden" id="isLoggedIn" value='{{$is_logged_in}}' />

<!--Favorites form-->
@if(Auth::check())
  @if ($favorited = in_array($tmdbid, $favorites_auth))
     {{ Form::open(['method' => 'DELETE', 'route' => 'favorites.destroy', 'id'=>'favForm']) }}
     {{ Form::hidden('movie-id', $tmdbid) }}

  @else
    {{ Form::open(['route' => 'favorites.store', 'id'=>'favForm']) }}
    {{ Form::hidden('movie-id', $tmdbid) }}

  @endif
    {{ Form::close() }}
@endif
          <ul class="nav nav-tabs">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-plus zengreen"></i> Add to </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#" class="watchList"><i class="glyphicon glyphicon-eye"></i> Watch List</a>
                  </li>
                <!--Favorites link -->
                @if(Auth::check())
                  <li><a href="javascript:void(0)" class="favorite"><i class="glyphicon {{ $favorited ? 'glyphicon-heart' : 'glyphicon-heart-empty' }}"></i>{{ $favorited ? ' Favorited' : ' Favorites' }} </a></li>
                @else
                  <li><a href="#" class="favorite"><i class="glyphicon glyphicon-heart-empty"></i>  Favorites</a></li>
                @endif
                </ul><!--Dropdown menu-->
            <li> <!--Dropdown-->
              <a href="#">Similar Movies</a>
            <li>
              <a href="#" id="related">Related Clips</a>
            </li>
            <li class="active">
              <a href="#">About</a>
            </li>
          </ul><!--Nav-tabs-->
    
    </div> <!--End Header-->




	<div class="col-md-4" id="leftCol">
      <div class="poster"></div>
      <div class="ratings"></div>
      <div class="sideInfo"></div>
      
		</div>
	<div class="col-md-8" id="mainCol">
      <div class="description">
        <p class="tagline"></p>
        <span class="overview"></span><br><br>
      </div>
      <div class="crew">
      </div>
      <div id="cast">
      	<h2 id="cast-header"></h2>
		      <div class="col-sm-4" id="cast-col-1">
		      </div>
		      <div class="col-sm-4" id="cast-col-2">
		      </div>
		      <div class="col-sm-4" id="cast-col-3">
		      </div>
      </div><!--cast container-->
      <div class="reviews"></div>
		</div>
    </div><!--container-->
</div>
@endsection

@section('scripts')
<script>
//keys and paths
var api_key="ca85ff10880b1490989e8dbeb5932c00";
var img_path = "http://d3gtl9l2a4fn1j.cloudfront.net/t/p/";
var tomato_key="pfwh96pvezces4nybpv7qf8f";
var tomatoURL, imdb_id, rotten_id;
var isLoggedIn;
var id = '{{$tmdbid}}';
var cust_tomato = "{{ URL::asset('assets/img/customTomato.png') }}";

//initial TMDB movie data
var title, titleURI, poster_path, mainPoster, release_date, tagline, overview, runtime;
//strings we shall input into our own database of movies
var titleStr, releasedateStr, trailerStr, genreStr, posterStr;
var credits = [], posters=[], backdrops=[], trailers=[], languages=[];

//variables we will store for RT data
var genres=[], reviews=[], year;
var critics_rating, audience_rating;

$(function(){
  isLoggedIn = $('input#isLoggedIn').val();
  //Begin asynchronous calls starting with TMDB!
  var movieURL="https://api.themoviedb.org/3/movie/"+id+'?api_key='+api_key+'&append_to_response=images,credits,trailers';
  $('#preloader').show();
  $.getJSON( movieURL, {
    format: "json"
  })
    .done(function( data ) {
      console.log('TMDB: ', data);
      $('.movie-header').show();
      var imdb = data.imdb_id;
      imdb_id = imdb.replace(/tt/, "");
      //build local data
      title = data.title, release_date = data.release_date, tagline = data.tagline, overview = data.overview;
      genres = data.genres;
      //stringify to pass to laravel
      titleStr = JSON.stringify(title);
      releasedateStr = JSON.stringify(release_date);
      genreStr = JSON.stringify(genres);

      if(data.spoken_languages.length > 0){
        for(var k in data.spoken_languages)
          {
            languages.push(data.spoken_languages[k].name);
          }
      }
      
      poster_path = data.poster_path;
      posterStr = JSON.stringify(poster_path);
      runtime = data.runtime;
      credits = data.credits;

      for(var i=0; i<4; i++){
        if(data.images.posters[i])
        {
          posters.push(data.images.posters[i]);
        }
      }

      for(var j=0; j<5; j++){
        if(data.images.backdrops[j])
        {
          backdrops.push(data.images.backdrops[j]);
        }
      }

      titleURI = encodeURIComponent(title);
      tomatoURL="http://api.rottentomatoes.com/api/public/v1.0/movie_alias.json?id=" + imdb_id + "&type=imdb&apikey="+tomato_key;
      //next get youtube trailer
      getYoutubeTrailers(title);
  })
  .error(function() {
    $('#preloader').hide();
   $('#mainCol').append("<h1>Error 404: Movie not found</h1>") 
  });
  
})

// Request Youtube API
function getYoutubeTrailers(title){
  var search_input = title + ' trailer';
  var keyword= encodeURIComponent(search_input); 
  var yt_url='http://gdata.youtube.com/feeds/api/videos?q='+keyword+'&format=5&max-results=1&v=2&alt=jsonc'; 
  trailerStr = JSON.stringify(yt_url);

  $.ajax({
    type: "GET",
    url: yt_url,
    dataType:"jsonp",
    success: function(response){
      //do stuff
      console.log('Youtube: ', response);
      if(response.data.items)
      {
        $.each(response.data.items, function(i,data)
          {
            var video_id=data.id;
            var yt_trailer = 'http://www.youtube.com/v/'+video_id+'?fs=1&amp;autoplay=1;iv_load_policy=3';
            //var yt_trailer = 'http://www.youtube.com/watch?v='+video_id;
            var yt_thumb = data.thumbnail.hqDefault;
            trailers.push({'yt_url': yt_trailer, 'thumb': yt_thumb});
         });
      }
            getRottenTomatoes(tomatoURL);
    },
    error: function(e){
      $('#preloader').hide();
      console.log('Error: ', e.message);
    }
  });
}

//Last request to Rotten Tomatoes, then build output
function getRottenTomatoes(rtURL){
  $.ajax({
    url: rtURL,
    dataType: 'jsonp',
    success: function(movie){
      console.log('Rotten Tomatoes: ', movie);
      rotten_id = movie.id;
      try{
        year = movie.year;
        if(movie.ratings)
              critics_rating = movie.ratings.critics_score, audience_rating = movie.ratings.audience_score;
      }catch(e){
        console.log(e);
      }

      //display year if exists
      if(year){
          $('.movie-header .title').append(title+'<span class="year"> ('+year+')</span>');
        }else{
          $('.movie-header .title').append(title);
        }

      //Add tagline and description
      if(tagline){
          $('#mainCol .tagline').append('"<i>'+tagline+'</i>"');
      }
      if(overview)
        $('#mainCol .overview').append(overview);

      //add main poster
      if(poster_path){
        mainPoster = img_path+'w500/'+poster_path;
        $('#leftCol .poster').append(' <a class="fancybox-thumb" data-thumbnail="'+mainPoster+'" href="'+mainPoster+'"><img src="'
              +mainPoster+'" width="270" height="400" alt="poster"/></a>');
      }

    //Display ratings
      if(critics_rating && critics_rating > 0){
          $('#leftCol .ratings').append('<b>Ratings:</b><br><img src="'+cust_tomato+'" width="35" height="35" title="Critics Score from Rotten Tomatoes"/> <span class="percent"> '+critics_rating+ '%</span>  ');}

      if(audience_rating && audience_rating > 60){
          $('#leftCol .ratings').append('&nbsp; &nbsp;<i class="fa fa-thumbs-o-up fa-lg" title="Audience Rating"></i> <span class="percent">'+ audience_rating + '%</span>');
        }else if(audience_rating && audience_rating < 60){
          $('#leftCol .ratings').append('&nbsp; &nbsp;<i class="fa fa-thumbs-o-down fa-lg" title="Audience Rating"></i> <span class="percent">'+ audience_rating + '%</span>');
        }


      //remaining posters
      if(posters.length>1){
        for(var i=1; i<posters.length; i++){
            var subPoster = img_path+'w500/'+posters[i].file_path;
            $('#leftCol .poster').append(' <a class="fancybox-thumb" data-thumbnail="'+subPoster+'" href="'+subPoster+'"></a>');
        }
      }

    //fancybox for posters
    $(".fancybox-thumb")
        .attr('rel', 'gallery')
        .fancybox({
            padding: 7,
            helpers: {
                thumbs: {
                    width  : 40,
                    height : 40,
                    source  : function(current) {
                        return $(current.element).data('thumbnail');
                    }
                }
            }
        });

      //if there are trailers, display them with fancybox attr
      try{
        if(trailers){
          $('#mainCol .description').append('<br><a class="fancybox-trailers fancybox.iframe" href="'+ trailers[0].yt_url +'">Trailer<br><i class="fa fa-youtube-play fa-3x"></i></a>');
          
          if(trailers.length>1){
            for(var j=1; j<trailers.length; j++){
              $('#mainCol .description').append('<a class="fancybox-trailers fancybox.iframe" href="'+ trailers[j].yt_url +'"></a>');
            }          
          }
        }
      }catch(e){
        $('#preloader').hide();
        console.log(e);
      }

      //Genres
      if(genres.length>0){
        $('#leftCol .sideInfo').append('<b>Genres:</b> '); //genres header
        for(var k in genres){
          if(k!=genres.length-1)
            $('#leftCol .sideInfo').append(genres[k].name + ', ');
          else
            $('#leftCol .sideInfo').append(genres[k].name); //last elem
        }
      }
      //Runtime
      if(runtime){
        $('#leftCol .sideInfo').append('<h5><b>Runtime:</b> '+runtime +' min.</h5>');
      }
      //Release date
      if(release_date){
        $('#leftCol .sideInfo').append('<h5><b>Release:</b> '+release_date+' </h5>');
      }
      //Languages
      if(languages){
        $('#leftCol .sideInfo').append('<b>Languages:</b> '); //genres header
        for(var l in languages){
          if(l!=languages.length-1)
            $('#leftCol .sideInfo').append(languages[l] + ', ');
          else
            $('#leftCol .sideInfo').append(languages[l]); //last elem
        }
      }

      //Cast and crew
      if(credits.crew){
        var directors =[], writers =[];
        for(var c in credits.crew){
          if(credits.crew[c].department=='Directing')
            directors.push({'id':credits.crew[c].id, 'name': credits.crew[c].name, 'profile_path':credits.crew[c].profile_path});
          if(credits.crew[c].department=='Writing')
            writers.push({'id':credits.crew[c].id, 'name': credits.crew[c].name, 'profile_path':credits.crew[c].profile_path, 'job':credits.crew[c].job});
        }
      }
      if(credits.cast){
        var abridged_actors =[]; //list of first 6 actors
        for(var a=0; a<6; a++){
          if(credits.cast[a]){
            abridged_actors.push({'id':credits.cast[a].id, 'name':credits.cast[a].name, 'character':credits.cast[a].character, 'profile_path':credits.cast[a].profile_path});            
          }
        }
      }

      //output directors
      if(directors.length > 0){
        $('#mainCol .crew').append('Directed by: ');
        for(var d in directors){
          if(d!=directors.length-1)
           {
            $('#mainCol .crew').append('<a href="#">'+directors[d].name + '</a>, ');
           }
          else
            $('#mainCol .crew').append('<a href="#">'+directors[d].name + '</a>'); //last elem
        }
      }

      //output writers
      if(writers.length >0){
        var writerStr = '';
        for(var w in writers){
          if(writers[w].job == 'Writer'){
            if(w!=writers.length-1) //if it's not the last element, add a comma
              writerStr += '<a href="#">'+writers[w].name+'</a>, ';
            else
              writerStr += '<a href="#">'+writers[w].name+'</a>';
          }
        } //end for each writer 
        if(writerStr)
          $('#mainCol .crew').append('<br>Written by: '+writerStr); //output final str of writers at the end
      }

      console.log(abridged_actors);

      //output cast
      if(abridged_actors.length>0){
         $('#mainCol #cast #cast-header').append('Cast');
        for(abr in abridged_actors){
          if(abr==0 || abr==3){
            $('#mainCol #cast #cast-col-1').append('<img src="'+img_path+'w92/'+abridged_actors[abr].profile_path+ '" height="122" width="82"/>'
              +'<p><a href="#">'+abridged_actors[abr].name+'</a> as <i>'+abridged_actors[abr].character+'</i></p>');
          }
          else if(abr==1 || abr==4)
            $('#mainCol #cast #cast-col-2').append('<img src="'+img_path+'w92/'+abridged_actors[abr].profile_path+ '" height="122" width="82"/>'
              +'<p><a href="#">'+abridged_actors[abr].name+'</a> as <i>'+abridged_actors[abr].character+'</i></p>');
          else if(abr==2 || abr==5)
            $('#mainCol #cast #cast-col-3').append('<img src="'+img_path+'w92/'+abridged_actors[abr].profile_path+ '" height="122" width="82"/>'
              +'<p><a href="#">'+abridged_actors[abr].name+'</a> as <i>'+abridged_actors[abr].character+'</i></p>');
        }
      }

      //hide loader gif when stuff has been loaded
      $('#preloader').hide();

      $("a#related").click(function(){
        window.location = id+'/related';
      });

      //add our hidden input fields for our backend to detect
      $('#favForm').append('<input name="movie-title" type="hidden" value=' + titleStr + '>');
      $('#favForm').append('<input name="rotten-id" type="hidden" value=' + rotten_id + '>');
      $('#favForm').append('<input name="imdb-id" type="hidden" value=' + imdb_id + '>');
      $('#favForm').append('<input name="year" type="hidden" value=' + year + '>');
      $('#favForm').append('<input name="release-date" type="hidden" value=' + releasedateStr + '>');
      $('#favForm').append('<input name="trailer" type="hidden" value=' + trailerStr + '>');
      $('#favForm').append('<input name="genre" type="hidden" value=' + genreStr + '>');
      $('#favForm').append('<input name="poster-path" type="hidden" value=' + posterStr + '>');
      $('#favForm').append('<input name="critics-rating" type="hidden" value=' + critics_rating + '>');
      $('#favForm').append('<input name="audience-rating" type="hidden" value=' + audience_rating + '>');
      $('#favForm').append('<input name="runtime" type="hidden" value=' + runtime + '>');

      $(document).on("click",".favorite",function() {
        if(isLoggedIn=='yes'){
           $('#favForm').submit();
        }else{
          $('.flash-message').slideDown().delay(3500).slideUp();
        }
      });

      //fancybox for trailers
      $(".fancybox-trailers")
      .fancybox({
          scrolling   : 'hidden',
          maxWidth  : 800,
          maxHeight : 600,
          topRatio : 0.2,
          closeEffect : 'none',
          padding : 0,
          helpers:
              {
                overlay:{
                  css: { 'background': 'rgba(0, 0, 0, 0.95)' },
                  closeClick: false,
                  locked : false
                }
              }
      });
      
    },
    error: function(e){
      $('#preloader').hide();
      console.log('Error: ', e.message);
    }
  });
}
</script> 
@endsection
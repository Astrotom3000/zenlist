@extends('layouts.default')

@section('content')
<div class="content">
  <div class="container">  
@include('layouts/partials/_flash_message')
<h1></h1>
    <div class="results">
    </div>  
  </div>
</div>

@endsection
<!--Request to grab our TMDB search results-->
@section( 'scripts' )
<script>

var thumbnailpath = "http://d3gtl9l2a4fn1j.cloudfront.net/t/p/w92";
var noposter = "'http://d3a8mw37cqal2z.cloudfront.net/assets/e6497422f20fa74/images/no-poster-w92.jpg'";
var results = <?php echo json_encode($results); ?>;
var resMovies = results['movies'];
var resTV = results['tv'];
var resPeople = results['people'];
var movieCount = resMovies[0].length;
console.log(results);
for(a in resMovies)
{
  for(var b=0; b<10; b++)
  {
    var id = resMovies[a][b]['id'];
    var posterURL = thumbnailpath + resMovies[a][b]['posterpath'];

    var title = resMovies[a][b]['title'];
    var release = resMovies[a][b]['release'];

    //var director2 = resMovies[a][b]['directors'][1]['name'];
    if(resMovies[a][b]['directors'].length>0 && resMovies[a][b]['cast'].length>0)
    {
          var director = resMovies[a][b]['directors'][0]['name'];
          var movie_lead1 = resMovies[a][b]['cast'][0]['name'];
          var movie_lead2 = resMovies[a][b]['cast'][1]['name'];
          var movie_lead3 = resMovies[a][b]['cast'][2]['name'];
          var director2 = '', comma='';
      if(resMovies[a][b]['directors'][1]){
        comma = ', ';
        director2 = resMovies[a][b]['directors'][1]['name'];
      }
          $('.results').append('<div id="movie" class="result-box"><img src="'+posterURL+'" onerror="this.style.display='+noposter+'"/><a href="#" class="movie"><span class="title">'+title+'</span><span class="id" style="display:none;">'+id+'</span></a><br>Release date: ' + release
                + '<br>Starring: <a href="#">'+movie_lead1+'</a>, ' +'<a href="#">'+movie_lead2+'</a>, ' + '<a href="#">'+movie_lead3+'</a><br>'
                + 'Directed by: ' + '<a href="#"> '+director+'</a>'+comma+'<a href="#"> '+director2+'</a></div>');
    } else if(resMovies[a][b]['directors'].length>0 && resMovies[a][b]['cast'].length==0){
        var director = resMovies[a][b]['directors'][0]['name'];
        var director2 = '', comma='';
         if(resMovies[a][b]['directors'][1]){
          comma = ', ';
          director2 = resMovies[a][b]['directors'][1]['name'];}
        $('.results').append('<div id="movie" class="result-box"><img src="'+posterURL+'" onError="this.src='+noposter+'"/><a href="#" class="movie"><span class="title">'+title+'</span><span class="id" style="display:none;">'+id+'</span></a><br>Release Date: ' + release +'<br>'+'Directed by: ' + '<a href="#"> '+director+'</a>'+comma+'<a href="#"> '+director2+'</a></div>');
    }else
       $('.results').append('<div id="movie" class="result-box"><img src="'+posterURL+'" onerror="this.src='+noposter+'"/><a href="#" class="movie"><span class="title">'+title+'</span><span class="id" style="display:none;">'+id+'</span></a><br>Release Date: ' + release +'</div>');

  }
}

    $("a.movie").click(function(){
          var movie_id = $(this).children("span.id").text();
          window.location = 'movie/'+movie_id;
    });

</script>
@endsection


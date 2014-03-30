@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
  
@include('layouts/partials/_flash_message')
		<div class="results">
		</div>	
	</div>
</div>

@endsection
<!--Request to grab our TMDB search results-->
@section( 'scripts' )
<script>

var thumbnailpath = "http://d3gtl9l2a4fn1j.cloudfront.net/t/p/w92";
var noimg = "'none'";
var results = <?php echo json_encode($results); ?>;
var resMovies = results['movies'];
var resTV = results['tv'];
var resPeople = results['people'];

for(a in resMovies)
{
	for(b in resMovies[a])
	{
		var id = resMovies[a][b]['id'];
		var posterURL = thumbnailpath + resMovies[a][b]['posterpath'];
		var title = resMovies[a][b]['title'];
		var release = resMovies[a][b]['release'];
			
		$('.results').append('<div id="movie" class="result-box"><img src="'+posterURL+'" onerror="this.style.display='+noimg+'"/><a href="#" class="movie"><span class="title">'+title+'</span><span class="id" style="display:none;">'+id+'</span></a><br>' + release + '</div>');
	}
}

		$("a.movie").click(function(){
		      var movie_id = $(this).children("span.id").text();
		      window.location = 'movie/'+movie_id;
		});

</script>
@endsection


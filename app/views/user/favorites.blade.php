@extends('layouts.default')
@section('content')
<div class="content">
<div class="flash-message alert alert-warning" style="display:none;"><h4> Please log in to do that :)</h4></div>
    @include('layouts/partials/_flash_message')
        @if($auth_username == $user_name)
            <center><h1>Your Favorite Movies </h1>
            <p>Last updated: {{$last_updated_date}}</p></center>
        @else
           <center><h1><span class="zengreen"> {{ucfirst($user_name)}}'s </span>Favorite Movies </h1>
           <p>Last updated: {{$last_updated_date}}</p></center>
        @endif 
        <div class="container">
            <div class="row">
        @if ($moviesArr)
                    @foreach($moviesArr as $movie)
                    
                        <div class="col-md-5 col-md-offset-4 favorites-box">
                                                @if(Auth::check())
                          @if ($favorited = in_array($movie->tmdb_id, $favorites_auth))
                             {{ Form::open(['method' => 'DELETE', 'route' => 'favorites.destroy', 'class'=>'favForm']) }}
                             {{ Form::hidden('movie-id', $movie->tmdb_id) }}
                          @else
                            {{ Form::open(['route' => 'favorites.store', 'class'=>'favForm']) }}
                            {{ Form::hidden('movie-id', $movie->tmdb_id) }}
                        @endif
                          <div class="btn-group float-right">
                              <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"> Add to <span class="ion-plus zengreen"></span>

                              </button>
                              <ul class="dropdown-menu fallback">
                                <li><a href="#" class="watchList"><i class="fa fa-eye"></i> Watch List</a></li>
                               <li><a href="#" class="seenList"><i class="fa fa-eye-slash"></i> Seen List</a></li>
                                 <!--Favorites link -->
                                    @if(Auth::check())
                                    <li><a href="#" id="addFav" onClick="addFav($(this)); return false;"><i class="glyphicon {{ $favorited ? 'glyphicon-heart' : 'glyphicon-heart-empty' }}"></i>{{ $favorited ? ' Favorited' : ' Favorites' }} </a></li>
                                    @else
                                    <li><a href="#" id="addFav" onClick="addFav($(this)); return false;"><i class="glyphicon glyphicon-heart-empty"></i>  Favorites</a></li>
                                    @endif
                              <li>
                              <a href="#" class="customList"><i class="ion-leaf"></i> Custom List</a>
                              </li>
                              </ul>
                            </div>
                          {{ Form::close() }}
                        @endif
                        <h4><a href="{{ route('movie', $movie->tmdb_id) }}" class="movie">{{ $movie->title }} </a>
                       @if($movie->year)
                          ({{$movie->year}}) 
                       @endif
                       </h4>
                        <img src="{{$baseURL}}/{{$movie->poster_path}}"/>

                       </div>

                    @endforeach

        @else
          <center>  <h1>No favorites added yet.</h1></center>
        @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(function(){
    var isLoggedIn = "{{$is_logged_in}}";

})

function addFav(anchorElement) {
    var form = anchorElement.parents("form");
    form.submit();
} 

$('button li ul').hide().removeClass('fallback');
$('button li').hover(
    function () {
        $('ul', this).show();
    },
    function () {
        $('ul', this).hide();
    }
); 

</script>
@endsection
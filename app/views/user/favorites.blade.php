@extends('layouts.default')
@section('content')
<div class="content">
<div class="flash-message alert alert-warning" style="display:none;"><h4> Please log in to do that :)</h4></div>
    @include('layouts/partials/_flash_message')
        @if($auth_username == $user_name)
            <center><h1>Your Favorite Movies </h1></center>
        @else
           <center><h1><span class="zengreen"> {{ucfirst($user_name)}}'s </span>Favorite Movies </h1></center>
        @endif 
        <div class="container">
            <div class="row">
        @if ($moviesArr)
                    @foreach($moviesArr as $movie)
                    
                        <div class="col-md-4 col-md-offset-4 add-padding">
                        <input type="hidden" id="tmdb" value ="{{$movie->tmdb_id}}">
                       <h4><a href="#" id="movie">{{ $movie->title }} </a>({{$movie->year}}) </h4>
                        @if(Auth::check())
                          @if ($favorited = in_array($movie->tmdb_id, $favorites_auth))
                             {{ Form::open(['method' => 'DELETE', 'route' => 'favorites.destroy', 'id'=>'favForm']) }}
                             {{ Form::hidden('movie-id', $movie->tmdb_id) }}
                          @else
                            {{ Form::open(['route' => 'favorites.store', 'id'=>'favForm']) }}
                            {{ Form::hidden('movie-id', $movie->tmdb_id) }}
                        @endif
                          <div class="btn-group float-right">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Add to <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#" class="watchList"><i class="fa fa-eye"></i> Watch List</a></li>
                                 <!--Favorites link -->
                                    @if(Auth::check())
                                    <li><a href="javascript:void(0)" class="favorite"><i class="glyphicon {{ $favorited ? 'glyphicon-heart' : 'glyphicon-heart-empty' }}"></i>{{ $favorited ? ' Favorited' : ' Favorites' }} </a></li>
                                    @else
                                    <li><a href="#" class="favorite"><i class="glyphicon glyphicon-heart-empty"></i>  Favorites</a></li>
                                    @endif
                              </ul>
                            </div>
                          {{ Form::close() }}
                        @endif

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
    var tmdbID = $('input#tmdb').val();
    var isLoggedIn = "{{$is_logged_in}}";

    $('a#movie').click(function(){
        window.location = '/movie/'+ tmdbID;
    });

    $(document).on("click",".favorite",function() {
        if(isLoggedIn=='yes'){
           $('#favForm').submit();
        }else{
          $('.flash-message').slideDown().delay(3500).slideUp();
        }
      });
})

</script>
@endsection
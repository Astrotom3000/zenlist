

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
        <span class="glyphicon glyphicon-edit"></span>
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
  </div>

  {{ Form::close() }}
@endif


 


@if(Auth::check())
  @if ($favorited = in_array($movie->id, $favorites_auth))
     {{ Form::open(['method' => 'DELETE', 'route' => 'favorites.destroy', 'id'=>'favForm']) }}
     {{ Form::hidden('movie-id', $movie->id) }}
  @else
    {{ Form::open(['route' => 'favorites.store', 'id'=>'favForm']) }}
    {{ Form::hidden('movie-id', $movie->id) }}
  @endif

      <button type="submit">
        <i class="fav-button glyphicon {{ $favorited ? 'glyphicon-heart' : 'glyphicon-heart-empty' }}"></i>
    </button>

  {{ Form::close() }}
@endif


<!--Dropdown

<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
    <i class="fa fa-plus zengreen"></i> Add to </a>
    <ul class="dropdown-menu">
        <li><a href="#" class="watchList"><i class="glyphicon glyphicon-eye"></i> Watch List</a></li>
        @if(Auth::check())
        	<li><a href="javascript:void(0)" class="favorite"><i class="glyphicon {{ $favorited ? 'glyphicon-heart' : 'glyphicon-heart-empty' }}"></i>{{ $favorited ? ' Favorited' : ' Favorites' }} </a></li>
        @else
        	<li><a href="#" class="favorite"><i class="glyphicon glyphicon-heart-empty"></i>  Favorites</a></li>
        @endif
    </ul>
<li> -->
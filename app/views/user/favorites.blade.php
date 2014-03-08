@extends('layouts.default')
@section('content')
<div class="container">
@include('layouts/partials/_flash_message')
    @if(Auth::user()->username == $user_name)
        <center><h1>Your Favorite Movies </h1>
    @else
       <center><h1><span class="zengreen"> {{$user_name}}'s </span>Favorite Movies </h1>
    @endif 
    @if ($favorited_movies->count())
        @foreach(array_chunk($favorited_movies->all(), 4) as $row)
            <div class="row">
                @foreach($row as $movie)
                    <div class="col-md-4 col-md-offset-4">
                        <h2>{{ Movie::where('tmdb_id' = $favorited_movies->movie_id)->get()->title }}</h2>
                    
                    @include ('layouts/partials/_dropdown_form')
                    </div>
                @endforeach
            </div>
        @endforeach
    @else
        <h1>No favorites added yet.</h1>
    @endif

</div>
@stop
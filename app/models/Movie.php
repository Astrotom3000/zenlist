<?php

class Movie extends Eloquent {
    protected $fillable = ['title', 'tmdb_id', 'rottentomatoes_id', 'imdb_id', 'year','release_date', 'critics_rating', 'audience_rating', 'runtime', 'genre', 'poster_path'];
}

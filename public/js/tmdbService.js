angular.module("zenlist")
  .service("tmdbService", function tmdbService($http, $log, $q) {
    var nowPlaying = [];
    var popular = [];
    var upcoming = [];

    return {
      getNowPlaying: function (apikey) {
        var tmdbURL = "http://api.themoviedb.org/3/movie/now_playing";

        return $http.get(tmdbURL, {
          "params": {
            "api_key" : apikey
          }}).then(
            function (response) {
                angular.forEach(response.data.results, function(movie){
                  //for each movie, get the trailers, overview, genre
                  getExtraInfo(movie.id, apikey, nowPlaying);
                });
                return nowPlaying;
            });
      }, //now playing
      
      getPopular: function(apikey){
        var tmdbURL = "http://api.themoviedb.org/3/movie/popular";
        
        return $http.get(tmdbURL, {
          "params": {
            "api_key" : apikey
          }}).then(
            function (response) {
                angular.forEach(response.data.results, function(movie){
                  //for each movie, get the trailers, overview, genre
                  getExtraInfo(movie.id, apikey, popular);
                });
                return popular;
            });
    },//popular
    
    getUpcoming: function(apikey){
        var tmdbURL = "http://api.themoviedb.org/3/movie/upcoming";
        
        return $http.get(tmdbURL, {
          "params": {
            "api_key" : apikey
          }}).then(
            function (response) {
                angular.forEach(response.data.results, function(movie){
                  //for each movie, get the trailers, overview, genre
                  getExtraInfo(movie.id, apikey, upcoming);
                });
                return upcoming;
            });
    }//upcoming
    
    };


    function getExtraInfo(movieId, apikey, moviesArray){
      var movieURL = "http://api.themoviedb.org/3/movie/" + movieId;
      $http.get(movieURL, {
        "params" : {
          "api_key" : apikey
        }
      }).then(
        function (response){
          //console.log(response.data);
          moviesArray.push({"id": response.data.id, "title": response.data.title, "overview": response.data.overview, "popularity":response.data.popularity, "poster_path": response.data.poster_path, "genres": response.data.genres, "runtime": response.data.runtime, "release_date": response.data.release_date, "revenue": response.data.revenue, "vote_average": response.data.vote_average});
        });
    } //get extra info

  });
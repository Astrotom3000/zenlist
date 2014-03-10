angular.module("zenlist")
  .service("tmdbService", function tmdbService($http, $log, $q) {
    return {
      getNowPlaying: function (apikey) {
        var tmdbURL = "http://api.themoviedb.org/3/movie/now_playing";

        return $http.get(tmdbURL, {
          "params": {
            "api_key" : apikey
          }}).then(
            function (response) {
              return response.data.results;
            });
      }, //now playing
      
      getPopular: function(apikey){
        var tmdbURL = "http://api.themoviedb.org/3/movie/popular";
        
        return $http.get(tmdbURL, {
          "params": {
            "api_key" : apikey
          }}).then(
            function (response){
              return response.data.results;
            });
    },//popular
    
    getUpcoming: function(apikey){
        var tmdbURL = "http://api.themoviedb.org/3/movie/upcoming";
        
        return $http.get(tmdbURL, {
          "params": {
            "api_key" : apikey
          }}).then(
            function (response){
              return response.data.results;
            });
    }//upcoming
    
    };
  });
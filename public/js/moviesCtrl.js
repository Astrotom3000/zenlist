angular.module("zenlist")
    .controller("MoviesCtrl", function ($scope, $http, $log, $q, tmdbService) {
      var apikey = 'ca85ff10880b1490989e8dbeb5932c00';
      $scope.baseURL = 'http://image.tmdb.org/t/p/w185';
      $scope.nowplaying = [];
      $scope.popular = [];
      $scope.upcoming = [];
      //$scope.movies = {};
      
      var getTmdbPromise = tmdbService.getNowPlaying(apikey);
      var getTmdbPromise2 = tmdbService.getPopular(apikey);
      var getTmdbPromise3 = tmdbService.getUpcoming(apikey);
      
        //multiple async calls
      $q.all([getTmdbPromise, getTmdbPromise2, getTmdbPromise3]).then(function (response){
          
          $scope.nowplaying = response[0];
          $scope.popular = response[1];
          $scope.upcoming = response[2];

          //$log.log("Movies: ", $scope.movies);
          $log.log("Success: ", response);
        });
      
       $scope.convertToCurrency = function(val){
          var money = '$' + val.toLocaleString();
          return money;
       }
        
    });
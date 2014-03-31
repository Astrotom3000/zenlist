
<div class="container" ng-controller="MoviesCtrl" id="movies-container">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">In theaters</h1>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb" ng-repeat="movie in nowplaying | filter:query">
            <div class="thumbnail">
            	<a href="/movie/{{movie.id}}">
                    <img class="img-responsive" ng-src="{{baseURL}}/{{movie.poster_path}}">
                </a>
            </div>
            </div>
        </div>

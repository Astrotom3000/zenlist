<div class="content" ng-controller="MoviesCtrl">
<div class="container explore-container"><br>
	<div class="col-md-3"><br><input ng-model="query" placeholder=" Search ">
	 <h4>Sort by:</h4>
	  <select ng-model="orderProp">
	    <option value="title">Alphabetical</option>
	    <option value="-release_date">Newest</option>
	    <option value="release_date">Oldest</option>
	    <option value="-vote_average">Votes</option>
	    <option value="-popularity">Popularity</option>
	    <option value="-revenue">Revenue</option>
	    
	  </select>
	</div>
	<div class="col-md-9 exploreMain">
		<tabset>
		    <tab heading="In Theaters">
			    <br>
			    <div class="col-md-4 movie-box" ng-repeat="movie in nowplaying | filter:query | orderBy:orderProp">
					    <a href="/movie/{{movie.id}}" ><img ng-src="{{baseURL}}/{{movie.poster_path}}"><br>
					    {{movie.title}}</a><br>
					      Release: {{movie.release_date}}<br>
					     Vote average: {{movie.vote_average}}<br>

				</div>
			</tab>
		    <tab heading="Upcoming">
			    <br>
			    <div class="col-md-4 movie-box" ng-repeat="movie in upcoming | filter:query | orderBy:orderProp">
					     <a href="/movie/{{movie.id}}" ><img ng-src="{{baseURL}}/{{movie.poster_path}}"><br>
					     {{movie.title}}</a><br>
					      Release: {{movie.release_date}}<br>
					     Vote average: {{movie.vote_average}}<br>
				</div>
		    </tab>
		    <tab heading="Popular">	
			    <br>
			    <div class="col-md-4 movie-box" ng-repeat="movie in popular | filter:query | orderBy:orderProp">
					     <a href="/movie/{{movie.id}}" ><img ng-src="{{baseURL}}/{{movie.poster_path}}"><br>
					     {{movie.title}}</a><br>
					      Release: {{movie.release_date}}<br>
					     Vote average: {{movie.vote_average}}<br>
				<span>{{movie.revenue ? 'Revenue: ' + convertToCurrency(movie.revenue) : ' '}}</span>
				</div>
				  </tab>
		  </tabset>
		</div>
		</div>
</div>
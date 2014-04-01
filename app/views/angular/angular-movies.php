<div class="content" ng-controller="MoviesCtrl">
    <div class="container" id="movies-container">
            <div class="row">
                <div class="col-lg-9">
                    <tabset>
                        <tab heading="In Theaters" style="padding-left: 15px;"><br>
                            <div class="col-md-3" ng-repeat="movie in nowplaying | filter:query">
                                <div class="thumbnail">
                                	<a href="/movie/{{movie.id}}">
                                        <img class="img-responsive" ng-src="{{baseURL}}/{{movie.poster_path}}" onError="this.src='http://d3a8mw37cqal2z.cloudfront.net/assets/e6497422f20fa74/images/no-poster-w185.jpg'">
                                    </a>
                                </div>
                            </div>
                        </tab>
                        <tab heading="Upcoming"><br>
                            <div class="col-md-3" ng-repeat="movie in upcoming | filter:query">
                                <div class="thumbnail">
                                    <a href="/movie/{{movie.id}}">
                                        <img class="img-responsive" ng-src="{{baseURL}}/{{movie.poster_path}}">
                                    </a>
                                </div>
                            </div>
                        </tab>
                        <tab heading="Popular"><br>
                            <div class="col-md-3" ng-repeat="movie in popular | filter:query">
                                <div class="thumbnail">
                                    <a href="/movie/{{movie.id}}">
                                        <img class="img-responsive" ng-src="{{baseURL}}/{{movie.poster_path}}">
                                    </a>
                                </div>
                            </div>
                        </tab>
                    </tabset>
                </div><!--main section-->
                <div id="side-section" class="col-lg-3">
                <!--Filters-->
                <ul class="filter-list">
                    <span class="filter-header">filter by</span>
                    <li class="active"><a href="#"><i class="fa fa-clock-o"></i> Newest</a></li>
                    <li><a href="#"><i class="fa fa-star-o"></i> Highest Rating</a></li>
                    <li><a href="#"><i class="fa fa-heart-o"></i> Most popular</a></li>
                </ul>
                <!--Recent lists-->
                <div class="module-top"><i class="glyphicon glyphicon-list-alt"></i> &nbsp&nbspRecent Lists</div>
                <div class="module">
                    <ul class="comment-list">
                        <li class="comment">         
                        <div class="comment-body">
                        <h4 class="comment-heading"><a href="#">List title</a> by <a href="#">User</a> <span class="time">4:34am</span></h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at.</p>
                        </div>
                        </li>
                        <li class="comment">         
                        <div class="comment-body">
                        <h4 class="comment-heading"><a href="#">List title</a> by <a href="#">User</a> <span class="time">4:34am</span></h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at.</p>
                        </div>
                        </li><li class="comment">         
                        <div class="comment-body">
                        <h4 class="comment-heading"><a href="#">List title</a> by <a href="#">User</a> <span class="time">4:34am</span></h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at.</p>
                        </div>
                        </li><li class="comment">         
                        <div class="comment-body">
                        <h4 class="comment-heading"><a href="#">List title</a> by <a href="#">User</a> <span class="time">4:34am</span></h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at.</p>
                        </div>
                        </li>
                    </ul>
                    </div>
         </div>
    </div>
</div>
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <div class="col-sm-5 col-md-5 pull-left">
        <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
        </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Movies</a></li>
        <li><a href="#">TV Shows</a></li>
        <li><a href="#">People</a></li>
        <li><a href="#">Community</a></li>
      </ul>
                <!--if authenticated user show link to lists and link to profile-->
                @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icomoon icon-menu"></i>  My Lists</a>
                        <ul class="dropdown-menu fallback">
                          <li><a href='#'><i class="fa fa-eye"></i> Watchlist</a></li>
                          <li><a href='#'><i class="fa fa-eye-slash"></i> Seenlist</a></li>
                          <li><a href="{{ URL::route('user.favorites', Auth::user()->username) }}"><i class="icomoon icon-heart"></i> Favorites</a></li>
                          <li>
                          <a href="#" class="customList"><i class="ion-leaf"></i> Custom List</a>
                          </li>
                        </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icomoon icon-user"></i>  {{ Auth::user()->username }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li>{{ HTML::link('profile', 'Profile') }}</li>
                          <li class="divider"></li>
                          <li>{{ HTML::link('logout', 'Logout') }}</li>
                        </ul>
                  </li>
                </ul>
                <!--else show login/register link-->
                @else
                  <p class="navbar-text pull-right">
                    <a href="/login" class="navbar-link">login</a> or <a href="/register" class="navbar-link">register</a>
                  </p>
                @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
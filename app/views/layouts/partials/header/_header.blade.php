<div id="header">
    <div class="navbar navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
         <a href="index.htm"> <h1>.</h1></a>
          <div class="nav-collapse collapse">
          <!--Search bar-->
              {{ Form::open(array("route" => "search.store", 'class'=>'navbar-form pull-left', 'id'=>'searchForm')) }}
        <div class="input-append">
        {{ Form::text('searchterm', '', array('class' => 'span3', 'placeholder' => 'Search for movies, tv shows, people.')) }}
          <button type="submit" class="btn btn-search btn-primary" id="submitbutton"><i class="fa fa-search"></i></button> 
        </div><!-- /auto-search -->
    {{ Form::close() }}  

            <ul class="nav pull-left">
              <li class="active"><a href="/">Movies</a></li>
              <li><a href="#">TV Shows</a></li>
              <li><a href="#">People</a></li>
            </ul>
         @if(Auth::check())
          <ul class="nav pull-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icomoon icon-menu"></i>  My Lists</a>
                    <ul class="dropdown-menu fallback">
                      <li><a href='#'><i class="fa fa-eye"></i> Watchlist</a></li>
                      <li><a href='#'><i class="fa fa-eye-slash"></i> Seenlist</a></li>
                      <li><a href="{{ route('user.favorites', Auth::user()->username) }}"><i class="icomoon icon-heart"></i> Favorites</a></li>
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
          @else
           <p class="navbar-text pull-right">
            <a href="login" class="navbar-link">login</a> or <a href="register" class="navbar-link">register</a>
            </p> 
         @endif
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
 </div>
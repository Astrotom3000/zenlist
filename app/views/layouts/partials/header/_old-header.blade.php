<nav class="navbar navbar-default add-padding" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><span class="pad-left"><img src="{{ URL::asset('assets/img/leaflogo.png') }}"/> Zenlist</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
    {{ Form::open(array("route" => "search.store", 'class'=>'navbar-form navbar-left', 'id'=>'searchForm')) }}
      <div class="auto-search">
        <div class="input-group">
        {{ Form::text('searchterm', '', array('class' => 'typeahead', 'placeholder' => 'Search for movies, tv shows, people.')) }}
          <span class="input-group-btn">
          <button type="submit" class="btn btn-default btn-lg" id="submitbutton"><i class="glyphicon glyphicon-search"></i></button>          </span>
        </div><!-- /input-group -->
      </div>
    {{ Form::close() }}  
      <ul class="nav navbar-nav navbar-right pad-right">
      @if(Auth::check())
                  <li><a href="/">Home</a></li>
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
                  <li><a href="/">Home</a></li>
                  <li>{{ HTML::link('register', 'Register') }}</li>
                  <a href="{{ URL::route('signin') }}" class="btn btn-clear shift-right">Sign in</a> 
                  </ul>  
                     
      @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
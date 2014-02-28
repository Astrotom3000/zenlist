<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>zenlist</title>
	<link rel="stylesheet" href="{{ URL::asset('assets/css/main.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/simplepajinate.css') }}">
  <link rel="icon" type="ico" href="{{ URL::asset('assets/img/favicon.ico') }}">
  <style>
.pajinate {
  display: inline-block;
  padding-left: 0;
  margin-top: 24px;
  border-radius: 4px;
}
.pajinate > a,
.pajinate > span {
  position: relative;
  float: left;
  padding: 6px 12px;
  line-height: 1.428571429;
  text-decoration: none;
  color: #6dbc63;
  background-color: #ffffff;
  border: 1px solid #dddddd;
  margin-left: -1px;
}
.pajinate:first-child > a,
.pajinate:first-child > span {
  margin-left: 0;
  border-bottom-left-radius: 4px;
  border-top-left-radius: 4px;
}
.pajinate:last-child > a,
.pajinate:last-child > span {
  border-bottom-right-radius: 4px;
  border-top-right-radius: 4px;
}
.pajinate > a:hover,
.pajinate > span:hover,
.pajinate > a:focus,
.pajinate > span:focus {
  color: #49933f;
  background-color: #eeeeee;
  border-color: #dddddd;
}
.pajinate > .active > a,
.pajinate > .active > span,
.pajinate > .active > a:hover,
.pajinate > .active > span:hover,
.pajinate > .active > a:focus,
.pajinate > .active > span:focus {
  z-index: 2;
  color: #ffffff;
  background-color: #6dbc63;
  border-color: #6dbc63;
  cursor: default;
}
.pajinate > .disabled > span,
.pajinate > .disabled > span:hover,
.pajinate > .disabled > span:focus,
.pajinate > .disabled > a,
.pajinate > .disabled > a:hover,
.pajinate > .disabled > a:focus {
  color: #999999;
  background-color: #ffffff;
  border-color: #dddddd;
  cursor: not-allowed;
}</style>
</head>
<body>
<section id="navigation">
<!--Navigation-->
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
      <a class="navbar-brand" href="{{ URL::route('explore') }}"><span class="pad-left"><img src="{{ URL::asset('assets/img/leaflogo.png') }}"/> Zenlist</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
    {{ Form::open(array("route" => "search.store", 'class'=>'navbar-form navbar-left', 'id'=>'searchForm')) }}
			<div class="auto-search">
				<div class="input-group">
        {{ Form::text('searchterm', '', array('class' => 'typeahead', 'placeholder' => 'Search for movies, tv shows, people.')) }}
					<span class="input-group-btn">
          <button type="submit" class="btn btn-default btn-lg" id="submitbutton"><i class="glyphicon glyphicon-search"></i></button>					</span>
				</div><!-- /input-group -->
			</div>
		{{ Form::close() }}  
      <ul class="nav navbar-nav navbar-right pad-right">
      @if(Auth::check())
                  <li>{{ HTML::link('explore', 'Explore') }}</li>
                  <li>{{ HTML::link('lists', 'My Lists') }}</li>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>  {{ Auth::user()->username }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li>{{ HTML::link('profile', 'Profile') }}</li>
                      <li class="divider"></li>
                      <li>{{ HTML::link('logout', 'Logout') }}</li>
                    </ul>
                  </li>
                  </ul>
              @else
                  <li>{{ HTML::link('/', 'Home') }}</li>
                  <li>{{ HTML::link('explore', 'Explore') }}</li>
                  <li>{{ HTML::link('home', 'About') }}</li>
                  <li>{{ HTML::link('register', 'Register') }}</li>
                  <a href="{{ URL::route('signin') }}" class="btn btn-clear shift-right">Sign in</a> 
                  </ul>  
                     
      @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</section><!--/Navigation Header-->
<section id="content">
			@yield('content')
</section>


<!--Declare javascript here to load page faster-->
<script src="{{ URL::asset('assets/js/jquery.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/typeahead.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/handlebars.js') }}"></script>
<script src="{{ URL::asset('assets/js/autosearch.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.pajinate.js') }}"></script>
<!--Load custom scripts after base-->
@yield('scripts')

</body>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>zenlist</title>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/main.css') }}">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link href="//code.ionicframework.com/ionicons/1.4.1/css/ionicons.min.css" rel="stylesheet">
  <link href="{{ URL::asset('assets/js/flexslider/flexslider.css') }}" rel="stylesheet">
  <link data-require="fancybox@2.1.5" data-semver="2.1.5" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" />
  <link data-require="fancybox@2.1.5" data-semver="2.1.5" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-thumbs.css" />
  <link data-require="fancybox@2.1.5" data-semver="2.1.5" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-buttons.css" />

  <!--
  <link href="{{ URL::asset('assets/js/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/js/fancybox/helpers/jquery.fancybox-buttons.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/js/fancybox/helpers/jquery.fancybox-thumbs.css') }}" rel="stylesheet">
  -->
  <link rel="icon" type="ico" href="{{ URL::asset('assets/img/favicon.ico') }}">
</head>
<body ng-app="zenlist">
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

      <a class="scrollup" href="#">Scroll</a>
</section>


<!--Declare javascript here to load page faster-->
<script src="{{ URL::asset('assets/js/jquery.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/typeahead.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/handlebars.js') }}"></script>
<script src="{{ URL::asset('assets/js/autosearch.js') }}"></script>
<script src="{{ URL::asset('assets/js/angular/angular.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/angular/angular-ui.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>
<script src="{{ URL::asset('js/tmdbService.js') }}"></script>
<script src="{{ URL::asset('js/moviesCtrl.js') }}"></script>
<script data-require="fancybox@2.1.5" data-semver="2.1.5" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
<script data-require="fancybox@2.1.5" data-semver="2.1.5" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js"></script>
<script data-require="fancybox@*" data-semver="2.1.5" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-thumbs.js"></script>
<script data-require="fancybox@*" data-semver="2.1.5" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-media.js"></script>
<script src="{{ URL::asset('assets/js/flexslider/jquery.flexslider-min.js') }}"></script>
<script src="{{ URL::asset('assets/js/flexslider/jquery.mousewheel.js') }}"></script>
<script src="{{ URL::asset('assets/js/flexslider/jquery.easing.js') }}"></script>

<!--
<script src="{{ URL::asset('assets/js/fancybox/jquery.fancybox.js') }}"></script>
<script src="{{ URL::asset('assets/js/fancybox/jquery.fancybox.pack.js') }}"></script>
<script src="{{ URL::asset('assets/js/fancybox/helpers/jquery.fancybox-buttons.js') }}"></script>
<script src="{{ URL::asset('assets/js/fancybox/helpers/jquery.fancybox-thumbs.js') }}"></script>
<script src="{{ URL::asset('assets/js/fancybox/helpers/jquery.fancybox-media.js') }}"></script>
-->
<script>
  $('div.flash-message').delay(2000).slideUp();
 $('div.form-error').delay(4000).slideUp();

$('nav li ul').hide().removeClass('fallback');
$('nav li').hover(
    function () {
        $('ul', this).show();
    },
    function () {
        $('ul', this).hide();
    }
);

// scroll-to-top button show and hide
jQuery(document).ready(function(){
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 1000) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
    }
});
// scroll-to-top animate
jQuery('.scrollup').click(function(){
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});
</script>
@yield('scripts')

</body>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>zenlist</title>
  <!--Assets for css-->
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
@include('layouts/partials/header/_old-header')

<section id="content">
			@yield('content')
</section>
 <a class="scrollup" href="#">Scroll</a>
@include('layouts/partials/footer/_footer')

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
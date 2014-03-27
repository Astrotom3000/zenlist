@extends('layouts.default')

@section('content')
<div class="content">
  <div class="container">
  
@include('layouts/partials/_flash_message')
    <!--<h4>Search term: <strong>{{ $searchword }}</strong></h4>-->
    <div class="page-header align-center"></div>
    <div class="results">
    </div>  
  </div>
</div>
@endsection
<!--Request to grab our TMDB search results-->
@section( 'scripts' )
@endsection


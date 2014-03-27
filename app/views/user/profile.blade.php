@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
	<h1>Profile page for <span class="highlight">{{ Auth::user()->username }}</span></h1>
	<h2>Your email: <span class="highlight">{{ Auth::user()->email }}</span></h2>
	</div>
</div>
@stop
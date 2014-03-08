@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
@include('layouts/partials/_flash_message')
		<div class="page-header">		
			<center><h1>New releases, in theaters, popular movies.</h1></center>
		</div>
		<div class="row">			
			<div class="col-md-4">
				<img src="{{ URL::asset('assets/img/screen.png') }}"/>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, quibusdam quod explicabo veritatis accusamus aut minus maxime numquam consequuntur est! Odio, nobis, vitae nisi quaerat in necessitatibus beatae delectus iste.</p>
			</div>
			<div class="col-md-6">
				<img src="{{ URL::asset('assets/img/screen2.png') }}"/>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, quibusdam quod explicabo veritatis accusamus aut minus maxime numquam consequuntur est! Odio, nobis, vitae nisi quaerat in necessitatibus beatae delectus iste.</p>
			</div>

		</div>
	</div>
</div>
@stop


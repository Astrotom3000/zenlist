@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
		<center><h1>Join us, it's easy!</h1><br>
				<!-- Validation Errors if any -->
				@if($errors->has())
				<div class="form-group input-form" align="left">
					<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						@foreach($errors->all() as $message)

						<p>{{ $message }}</p>

						@endforeach
					</div>	
				</div>
				@endif

					{{ Form::open(array('before' => 'csrf', 'route' => 'registration.store')) }}
					<div class="form-group input-form">
						{{ Form::email('email', '', array('class' => 'form-control input-field', 'placeholder' => 'Enter your email')) }}
						<label class="field-icon fa fa-envelope"></label>
					</div>

					<div class="form-group input-form">
						{{ Form::password('password', array('class' => 'form-control input-field', 'placeholder' => 'Choose a password')) }}
						<label class="field-icon fa fa-lock"></label>
					</div>

					<div class="form-group input-form">
						{{ Form::text('username', '', array('class' => 'form-control input-field', 'placeholder' => 'Choose a username')) }}
						<label class="field-icon fa fa-user"></label>
					</div>		
					<div class="form-group input-form">
						{{ Form::submit('Register', array('class' => 'btn btn-primary btn-block input-form')) }}
					</div>
					{{ Form::token() . Form::close() }}



		</div>
	</div>
</div>


@stop
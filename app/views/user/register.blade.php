@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
	<div class="row">
			<div class="col-md-4 col-md-offset-4">
			<center><h1>Join us, it's easy!</h1><br>
					<!-- Validation Errors if any -->
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

					@if($errors->has())
					<div class="form-group input-form" align="left">
						<div class="form-error alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							@foreach($errors->all() as $message)
							<p>{{ $message }}</p>
							@endforeach
						</div>
					</div>	
					@endif		
						<div class="form-group input-form">
							{{ Form::submit('Register', array('class' => 'btn btn-primary btn-block input-form')) }}
						</div>
						{{ Form::token() . Form::close() }}
				</center>
				</div>
			</div>
		</div>
	</div>


@stop
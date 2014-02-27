@extends('layouts.default')

@section('content')
<div class="content">
	<div class="container">
	<center><h2>Please Sign in</h2><br>

				@if(Session::get('flash_message'))
				<div class="form-group input-form">
					<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							{{Session::get('flash_message')}}
					</div>
				</div>
				@endif

					{{ Form::open(array('before' => 'csrf', 'route' => 'sessions.store')) }}
					<div class="form-group input-form">
						{{ Form::email('email', '', array('class' => 'form-control input-field', 'placeholder' => 'Email')) }}
						<label class="field-icon fa fa-envelope"></label>
					</div>
					<div class="form-group input-form">
						{{ Form::password('password', array('class' => 'form-control input-field', 'placeholder' => 'Password')) }}
						<label class="field-icon fa fa-lock"></label>
					</div>
					<div class="form-group input-form">
						{{ Form::submit('Login', array('class' => 'btn btn-primary btn-block')) }}
						</div>
					<div class="form-group input-form align-right">
					{{ HTML::link('password/remind', ' Forgot your password?') }}
					</div>
					{{ Form::token() . Form::close() }}
				</div>
	</div>
</div>

@stop

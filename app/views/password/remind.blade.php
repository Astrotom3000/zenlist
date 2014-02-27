@extends('layouts.default')

@section('content')
    
    <center> <h2>Need to reset your password?</h2>
    </center>
        <div class="col-md-5 col-md-offset-3 "><br>
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error') }}
                </div>
        @elseif (Session::has('status'))
        <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('status') }}
                </div>
        @endif

        {{ Form::open() }}
          <div class="input-group">
                {{ Form::email('email', '', array('class' => 'form-control input-lg', 'placeholder' => 'Enter your email')) }}
            <span class="input-group-btn">{{ Form::submit('Reset', array('class' => 'btn btn-primary btn-lg')) }}</span>
        </div>
        {{ Form::close() }}
        </div>
    </div>
@stop
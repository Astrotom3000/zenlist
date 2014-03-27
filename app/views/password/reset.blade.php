@extends('layouts.default')

@section('content')
<div class="content pad-bottom">
        <center><h2>Set Your New Password</h2>
    </center>
        <div class="col-md-4 col-md-offset-4 "><br>

        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error') }}
                </div>
        @endif

        {{ Form::open() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                {{ Form::email('email', '', array('class' => 'form-control input-lg', 'placeholder' => 'Your Email')) }}
            </div>

            <div class="form-group">
                {{ Form::password('password', array('class' => 'form-control input-lg', 'placeholder' => 'New Password')) }}
            </div>

            <div class="form-group">
              {{ Form::password('password_confirmation', array('class' => 'form-control input-lg', 'placeholder' => 'Confirm Password')) }}
            </div>

                {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-lg btn-block')) }}
        </form>

        </div>
    </div>
@stop
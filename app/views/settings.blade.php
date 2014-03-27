@extends('layouts.default')

@section('content')
<h1>Settings</h1>

{{ Form::open(array('id' => 'form-add-setting', 'route' => 'settings.store')) }}

{{ Form::label( 'setting_name', 'Setting Name:' ) }}
{{ Form::text( 'setting_name', '', array(
    'id' => 'setting_name',
    'placeholder' => 'Enter Setting Name',
    'maxlength' => 20,
    'required' => true,
) ) }}
{{ Form::label( 'setting_value', 'Setting Value:' ) }}
{{ Form::text( 'setting_value', '', array(
    'id' => 'setting_value',
    'placeholder' => 'Enter Setting Value',
    'maxlength' => 30,
    'required' => true,
) ) }}
 
{{ Form::submit( 'Add Setting', array(
    'id' => 'btn-add-setting',
) ) }}
 
{{ Form::close() }}
<div id="result">
</div>
@stop

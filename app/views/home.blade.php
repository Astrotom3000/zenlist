@extends('layouts.default')

@section('content')
<!-- Landing home page for non-registered users -->
<div class="jumbotron">
  <div class="container">
    
    <h2>Discover and share your favorite movies here.</h2><br>
    <p>{{ HTML::link('register', 'Join today', array('class' => 'btn btn-primary btn-lg btn-embossed')) }} or {{ HTML::link('explore', 'Start Browsing', array('class' => 'btn btn-lg btn-browse')) }}</p>
    <p>&nbsp</p>
  </div>
</div>
<section id="feaures">
<div class="content">
  <div class="container">
    <center><h1>Check out our awesome features</h1></center><br>
    <div class="row">
      <div class="col-md-4">
      <h2>Feature 1</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, quibusdam quod explicabo veritatis accusamus aut minus maxime numquam consequuntur est! Odio, nobis, vitae nisi quaerat in necessitatibus beatae delectus iste.</p>
      </div>
      <div class="col-md-4">
      <h2>Feature 2</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, quibusdam quod explicabo veritatis accusamus aut minus maxime numquam consequuntur est! Odio, nobis, vitae nisi quaerat in necessitatibus beatae delectus iste.</p>
      </div>
      <div class="col-md-4">
      <h2>Feature 3</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, quibusdam quod explicabo veritatis accusamus aut minus maxime numquam consequuntur est! Odio, nobis, vitae nisi quaerat in necessitatibus beatae delectus iste.</p>
      </div>
    </div>
  </div>
</div>
</section>

@stop
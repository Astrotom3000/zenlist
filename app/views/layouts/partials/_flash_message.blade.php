    @if(Session::get('flash_message'))
    <div class="flash-message alert {{ Session::get('flash_type', 'alert-danger') }} alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      {{Session::get('flash_message')}}
    </div>
    @endif
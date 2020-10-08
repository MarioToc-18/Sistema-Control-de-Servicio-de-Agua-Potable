@if (session()->has('flash'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alerta!</h4>
        {{ session('flash') }}
    </div>
@endif

@if(Session::has('message-error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4><i class="icon fa fa-times"></i> Error!</h4>
      {{Session::get('message-error')}}
      {{Session::forget('message-error')}}

    </div>
@endif

@if(Session::has('message-warning'))
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4><i class="icon fa fa-exclamation-triangle"></i> Alerta!</h4>
      {{Session::get('message-warning')}}
      {{Session::forget('message-warning')}}

    </div>
@endif

@if(Session::has('message-info'))
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4><i class="icon fa fa-check"></i> Info!</h4>
      {{Session::get('message-info')}}
      {{Session::forget('message-info')}}
    </div>
@endif

@if(Session::has('message-success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4><i class="icon fa fa-check"></i> Info!</h4>
      {{Session::get('message-success')}}
      {{Session::forget('message-success')}}

    </div>
@endif
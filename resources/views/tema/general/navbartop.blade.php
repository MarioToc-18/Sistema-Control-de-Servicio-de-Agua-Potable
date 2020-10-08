<div class="container-fluid">
    <div class="navbar-btn">
        <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
    </div>

    <div class="navbar-brand">
        <a href="{{ route('inicio') }}"><img src="{{asset('alucid/img/logo2.png')}}" alt="Logo" class="img-responsive logo"></a>                
    </div>
    
    <div class="navbar-right">
        <div id="navbar-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a    
                        class="icon-menu"
                        href="{{ url('/logout') }}" 
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                          <i class="icon ion-power"></i><i class="icon-login"></i></a>
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="submit" value="logout" style="display: none;">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<img src="{{ asset(auth()->user()->imagen)}}" class="rounded-circle user-photo" alt="Perfil">
<div class="dropdown">
    <span>Bienvenido,</span>
    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{auth()->user()->nombres}}</strong></a>
    <ul class="dropdown-menu dropdown-menu-right account">
        <li><a href="{{route('perfil.editar',auth()->user()->id_usuario )}}"><i class="icon-user"></i>Mi perfil</a></li>
        <li><a href="{{route('perfil.usuario',auth()->user()->id_usuario )}}"><i class="icon-lock"></i>Cambiar Contraseña</a></li>
        <li class="divider"></li>
        <li>
        	<a  class="icon-menu"
            	href="{{ url('/logout') }}" 
           		onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
        		<i class="icon-power"></i> Cerrar
        	</a>
        </li>

        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="submit" value="logout" style="display: none;">
        </form>
    </ul>
</div>

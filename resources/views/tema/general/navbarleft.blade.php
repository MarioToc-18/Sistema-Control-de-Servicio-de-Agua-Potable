<div class="sidebar-scroll">
    <div class="user-account" style="min-width: 500px;">
        @include('tema.general.perfil')
    </div>
    <!-- Tab panes -->
    <div class="tab-content p-l-0 p-r-0">
        <div class="tab-pane active" id="menu">
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">                            
                    <li class=" {{ request()->is('inicio') ? 'active' : '' }}">
                        <a href="{{route('inicio')}}" class="has-arrow"><i class="icon-home"></i> <span>Dashboard</span></a>
                    </li>
                    
                    <li class="{{ request()->is('usuarios*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="has-arrow"><i class="icon-lock"></i> <span>Usuarios</span></a>
                        <ul>                                    
                            <li class="{{ request()->is('usuarios*') ? 'active' : '' }}"><a href="{{route('usuarios')}}">Gestionar Usuarios</a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('inicio/beneficiados*') ? 'active' : '' }}">
                        <a href="#App" class="has-arrow"><i class="icon-users"></i> <span>Beneficiados</span></a>
                        <ul>
                            <li class="{{ request()->is('inicio/beneficiados*') ? 'active' : '' }}">
                                <a href="{{route('beneficiados')}}">Listado</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class=" {{ request()->is('cobros*') ? 'active' : '' }}">
                        <a href="#Blog" class="has-arrow"><i class="icon-wallet"></i> <span>Cobros</span></a>
                        <ul>                                    
                            <li class="{{ request()->is('cobros/lecturas*') ? 'active' : '' }}">
                                <a href="{{route('lecturas.index')}}">Gestionar Lecturas</a>
                            </li>
                            <li class="{{ request()->is('cobros/recibos*') ? 'active' : '' }}">
                                <a href="{{route('recibos.index')}}">Gestionar Recibos</a>
                            </li>
                            <li class="{{ request()->is('cobros/realizados*') ? 'active' : '' }}">
                                <a href="{{route('recibos.cobrados')}}">Recibos Cobrados</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('imprimir*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="has-arrow"><i class="icon-printer"></i> <span>Imprimir Recibos</span></a>
                        <ul>                                    
                            <li class="{{ request()->is('imprimir/listado') ? 'active' : '' }}">
                                <a href="{{route('imprimir.index')}}">Agregar recibo</a>
                            </li>
                        </ul> 
                    </li>
                    
                    


                    <li class=" {{ request()->is('reportes*') ? 'active' : '' }}">
                        <a href="#FileManager" class="has-arrow"><i class="icon-notebook"></i> <span>Reportes</span></a>
                        <ul>                                    

                            <li class="{{ request()->is('reportes/recibos-fechas*') ? 'active' : '' }}">
                                <a href="{{route('reportes.recibos.fechas')}}">Control de cobros</a>
                            </li>

                            <li class="{{ request()->is('reportes/listado-beneficiados') ? 'active' : '' }}">
                                <a href="{{route('reportes.listado.beneficiados')}}" target="_blank">Beneficiados</a>
                            </li>

                            <li class="{{ request()->is('reportes/listado-recibos') ? 'active' : '' }}">
                                <a href="{{route('reportes.listado')}}" target="_blank">Listado general de recibos</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li class=" {{ request()->is('documentos*') ? 'active' : '' }}">
                        <a href="#" class="has-arrow"><i class="icon-cloud-download"></i> <span>Comité - Documentos</span></a>
                        <ul>                                    

                            <li class="{{ request()->is('documentos/documentos*') ? 'active' : '' }}">
                                <a href="{{asset('docs/REGLAMENTO-DE-AGUA-POTABLE-POR-BOMBEO.pdf')}}" target="_blank">Reglamento</a>
                            </li>

                            <li class="{{ request()->is('documentos/documentos') ? 'active' : '' }}">
                                <a href="{{asset('docs/TASA-DE-AGUA-POR-BOMBEO.pdf')}}" target="_blank">Tasa de Agua</a>
                            </li>

                            <li class="{{ request()->is('documentos/documentos') ? 'active' : '' }}">
                                <a href="{{asset('docs/INSTRUCCIONES-DEL-MANEJO-DEL-AGUA.pdf')}}" target="_blank">Instrucciones de Manejo de Agua</a>
                            </li>
                            
                        </ul>
                    </li>


                </ul>
            </nav>
        </div>
                             
    </div>          
</div>
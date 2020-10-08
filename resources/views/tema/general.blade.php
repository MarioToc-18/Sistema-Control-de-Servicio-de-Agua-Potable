<!doctype html>
<html lang="es">
<head>
    @include('tema.general.htmlhead')
</head>
<body class="{{config('global.tema')}}">

<!-- Page Loader -->

<!-- Overlay For Sidebars -->

<div id="wrapper">

    <nav class="navbar navbar-fixed-top">
        @include('tema.general.navbartop')
    </nav>

    <div id="left-sidebar" class="sidebar">
        @include('tema.general.navbarleft')
    </div>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">

                @yield('headerpage')

            </div>
            @include('tema.general.mensajes')
            @yield('pagecontent')
            

        </div>
    </div>
    
</div>

    @include('tema.general.scripts')
    
    <!-- Page Javascript -->
    @yield('pagescript')
</body>

</html>

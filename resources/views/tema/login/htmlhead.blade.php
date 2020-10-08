<title> {{ config('global.sistema') }} - @yield('htmlheadertitle', 'Login') </title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('alucid/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('libs/font-awesome/css/font-awesome.min.css')}}">
<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('alucid/css/main.css')}}">
<link rel="stylesheet" href="{{ asset('alucid/css/color_skins.css')}}">

@yield('pagestyle')
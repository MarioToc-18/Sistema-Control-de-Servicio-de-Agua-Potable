    <title> {{ config('global.sistema') }} - @yield('htmlheadertitle', config('global.sistema')) </title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">

    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('alucid/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/font-awesome.min.css')}}">
    
    <!-- ESTILOS DE CADA PAGINA -->
    @yield('pagestyle')
    
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('alucid/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('alucid/css/color_skins.css')}}">

  

    <style>
        .form-control {
          display: block;
          width: 100%;
          height: 34px;
          padding: 6px 12px;
          font-size: 14px;
          line-height: 1.42857143;
          color: #000000;
          background-color: #fff;
          background-image: none;
          border: 1px solid #ccc;
          border-radius: 0px !important;
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .input-group-addon {color: #555 !important;}
        .treeview > a {text-decoration: none !important;}
        .blue-tooltip + .tooltip > .tooltip-inner {background-color: #2e6b9e;}
        .blue-tooltip + .tooltip > .tooltip-arrow {border-bottom-color:#2e6b9e; }
        .select2-selection__rendered {line-height: 31px !important;}
        .select2-container .select2-selection--single {height: 35px !important;}
        .select2-selection__arrow {height: 34px !important;}
        .select2-container--default .select2-selection--single {border-radius: 0px !important;}
        
        .has-danger .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #a94442;
            color: #a94442 !important;
            border-radius: 4px;
        }
        .has-danger .select2-container--default .select2-selection--single span{
            color: #a94442 !important; 
        }
        

        .sidebar-nav .metismenu ul a::before{
            padding-left: 10px;
            font-family:'FontAwesome';
            content:'\f1ce';
            position:absolute;
            left:19px;
            font-weight: 400;
        }

        .sidebar-nav .metismenu>li .active a {
            color: #007bff;
            font-weight: 700;

        }
        .sidebar-nav .metismenu>li .active a:before {
            color: #007bff;
            font-weight: 700;
            font-family:'FontAwesome';
            content:'\f111';
        }

    </style>
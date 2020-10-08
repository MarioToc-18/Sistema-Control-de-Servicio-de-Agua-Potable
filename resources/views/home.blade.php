@extends('tema.general')

@section('htmlheadertitle', 'Dashboard')

@section('sylespage')
    <link rel="stylesheet" href="{{ asset('alucid/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('alucid/vendor/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{ asset('alucid/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">
    <link rel="stylesheet" href="{{ asset('alucid/vendor/toastr/toastr.min.css')}}">
@endsection
@section('pagetitle')
    @include('tema.general.headerpage')
@endsection


@section('pagecontent')
    <div class="row clearfix">
        @include('tema.general.dashboard.box')
    </div>

    <div class="row clearfix">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Top 10 Beneficiados con pagos pendientes</h2>
                </div>
                <div class="body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center">CUI</th>
                          <th scope="col" class="text-center">Nombre completo</th>
                          <th scope="col" class="text-center">Número de contador</th>
                          <th scope="col" class="text-center">Telefono</th>
                          <th scope="col" class="text-center">Recibos Pendientes</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($morosos as $item)
                            <tr>
                              <th scope="row">{{$item->nit}}</th>
                              <td>{{$item->nombre_completo}}</td>
                              <td class="text-center">{{$item->numero_contador}}</td>
                              <td class="text-center">{{$item->telefono}}</td>
                              <td class="text-center">{{$item->total}}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('pagescript')
	<script src="{{ asset('alucid/bundles/chartist.bundle.js')}}"></script>
	<script src="{{ asset('alucid/bundles/knob.bundle.js')}}"></script> <!-- Jquery Knob-->
	<script src="{{ asset('alucid/vendor/toastr/toastr.js')}}"></script>

	<script src="{{ asset('alucid/bundles/mainscripts.bundle.js')}}"></script>
	<script src="{{ asset('alucid/js/index.js')}}"></script>
@endsection
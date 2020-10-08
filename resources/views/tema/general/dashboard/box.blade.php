<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card overflowhidden number-chart">
        <div class="body">
            <div class="number">
                <h6>RECIBOS EMITIDOS</h6>
                <span>{{ $recibos->count() }}</span>
            </div>
            <small class="text-muted">{{ $recibosPendientes->count()}} Recibos pendientes de cobro</small><br>
            <small class="text-muted">{{ $recibosVencidas->count()}} Recibos vencidos</small><br>
            <small class="text-muted">{{ $recibosCobradas->count()}} Recibos cobradas</small>
        </div>
        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
        data-line-Width="1" data-line-Color="#4aacc5" data-fill-Color="#92cddc">1,4,2,3,1,5</div>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card overflowhidden number-chart">
        <div class="body">
            <div class="number">
                <h6>BENEFICIADOS</h6>
                <span>{{ $beneficiados->count() }}</span>
            </div>
            <small class="text-muted">Beneficiados registrados</small>
        </div>
        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
        data-line-Width="1" data-line-Color="#f79647" data-fill-Color="#fac091">1,4,1,3,7,1</div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card overflowhidden number-chart">
        <div class="body">
            <div class="number">
                <h6>CONTADORES</h6>
                <span>{{$contadores->count()}}</span>
            </div>
            <small class="text-muted">Contadores asignados a beneficiados</small>
        </div>
        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
        data-line-Width="1" data-line-Color="#604a7b" data-fill-Color="#a092b0">1,4,2,3,6,2</div>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card overflowhidden number-chart">
        <div class="body">
            <div class="number">
                <h6>USUARIOS</h6>
                <span>{{$usuarios->count()}}</span>
            </div>
            <small class="text-muted">Usuarios del sistema</small>
        </div>
        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
        data-line-Width="1" data-line-Color="#4f81bc" data-fill-Color="#95b3d7">1,3,5,1,4,2</div>
    </div>
</div>
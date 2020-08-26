@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="container-fluid mt-5">
          @if(auth()->user()->roles[0]->name == 'Administrador')
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                  </div>
                  <p class="card-category">Saldo de los clientes </p>
                  <h4 class="card-title">$ {{ number_format($saldo_total, 2) }}</h4>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">face</i>
                  </div>
                  <p class="card-category">Clientes totales</p>
                  <h4 class="card-title">{{ $estacion_total }}</h4>
                  <!--h3 class="card-title">49/50
                    <small>GB</small>
                  </h3-->
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">local_shipping</i>
                  </div>
                  <p class="card-category">Pipas</p>
                  <h4 class="card-title">{{ $pipas_total }}</h4>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">local_atm</i>
                  </div>
                  <p class="card-category">Solicitudes de saldo</p>
                  <h4 class="card-title">{{ $abonos_pendientes }}</h4>
                </div>
              </div>
            </div>
          </div>
          @endif

          <div class="row mt-5">
            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-chart">
                    <div class="card-header card-header-rose text-white" data-header-animation="true">
                        <!--div class="ct-chart" id="websiteViewsChart"></div-->
                        @include('Graphics.graphics',['color'=>'bg-success','terminal'=>$terminales[2][0],'gasolina'=>'Regular','fechas'=>$terminales[2][1],'vector_precio_valero'=>$terminales[2][2]])
                        
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>

                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                        </div>
                        <h4 class="card-title">Ventas Diarias</h4>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-chart">
                    <div class="card-header card-header-danger" data-header-animation="true">
                        <!--div class="ct-chart" id="websiteViewsChart"></div-->
                       
                           @include('Graphics.graphics',['color'=>'bg-danger','terminal'=>$terminales[2][0],'gasolina'=>'Supreme','fechas'=>$terminales[2][1],'vector_precio_valero'=>$terminales[2][4]])
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>

                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                        </div>
                        <h4 class="card-title">Ventas por semana</h4>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-chart">
                    <div class="card-header card-header-rose" data-header-animation="true">
                        <!--div class="ct-chart" id="websiteViewsChart"></div-->
                        <div aria-expanded="true" class="tab-pane active" id="link3">
                           @include('Graphics.graphics',['color'=>'bg-dark','terminal'=>$terminales[2][0],'gasolina'=>'Diesel','fechas'=>$terminales[2][1],'vector_precio_valero'=>$terminales[2][3]])
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>

                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                        </div>
                        <h4 class="card-title">Pedidos del último mes </h4>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
@endsection

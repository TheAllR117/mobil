@extends('layouts.app', ['page' => __('Gestión de Estaciones'), 'pageSlug' => __('Estaciones')])

@section('content')

<!--div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card bg-danger">
      <div class="card-header card-header-primary">
        <h4 class="card-title text-white">
          <a href="{{ route('estaciones.index') }}" title="Regresar a la lista">
              <i class="tim-icons icon-minimal-left text-white"></i>
          </a>
          {{ __($estacion->razon_social) }}
        </h4>
        <p class="card-category text-white">
          <b class="ml-3"><strong>RFC: </strong></b>{{ $estacion->rfc }}
          <b class="ml-3"><strong> CRE: </strong></b>{{ $estacion->cre }}
          <b class="ml-3"><strong>SH: </strong></b>{{ $estacion->sh }}
          <b class="ml-3"><strong>Crédito: </strong></b>${{ number_format($estacion->credito,2) }}
          <b class="ml-3"><strong>Crédito utilizado: </strong></b>${{ number_format($estacion->credito_usado,2) }}
          <b class="ml-3"><strong>Saldo: </strong></b>${{ number_format($estacion->saldo,2) }}
        </p>
      </div>
      
    </div>
  </div>
</div-->

<div class="row">
  <div class="col-8">
    <div class="card card-chart card-tasks">
        <div class="card-header ">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h2 class="card-title text-info">
                      <a href="{{ route('estaciones.index') }}" title="Regresar a la lista">
                        <i class="tim-icons icon-minimal-left text-info"></i>
                      </a>
                      VENTAS TOTALES
                    </h2>
                </div>
                <div class="col-sm-6">
                  <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                    <label class="btn btn-sm btn-primary btn-simple active" id="0">
                        <input type="radio" name="options" checked>
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Extra</span>
                        <span class="d-block d-sm-none">
                            EX
                        </span>
                    </label>
                    <label class="btn btn-sm btn-danger btn-simple" id="1">
                        <input type="radio" class="d-none d-sm-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Supreme</span>
                        <span class="d-block d-sm-none">
                            SU
                        </span>
                    </label>
                    <label class="btn btn-sm btn-default btn-simple" id="2">
                        <input type="radio" class="d-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Diésel</span>
                        <span class="d-block d-sm-none">
                            DI
                        </span>
                    </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body mt-4">
            <div class="chart-area mt-3">
                <canvas class="grafica_2" id="chartBig1"></canvas>
            </div>
        </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6">
    <div class="card card-tasks">
        <div class="card-header text-center">
          <h3 class="title d-inline text-info"> {{ __($estacion->razon_social) }}</h3><br>
          <h5 class="title d-inline text-light"> {{ __($estacion->cre) }}</h5><br>
          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
          <a class="btn btn-info animation-on-hover btn-sm text-white" href="{{ route('estaciones.edit', $estacion) }}" type="button">Editar</a>
          @endif
        </div>
        <div class="card-body">
          <div class="table-full-width table-responsive">
            <div class="card">
              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3 pr-1 pl-1">
                      credit_card
                    </i>
                  </div>
                </div>
                <div class="col-7 col-sm-7">
                  <strong class="text-dark">Crédito total</strong><br>
                  ${{ number_format($estacion->credito,2) }}
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3">local_atm</i>
                  </div>
                </div>
                <div class="col-7 col-sm-7">
                  <strong class="text-dark">Crédito utilizado</strong><br>
                  ${{ number_format($estacion->credito_usado,2) }}
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3">attach_money</i>
                  </div>
                </div>
                <div class="col-7 col-sm-7">
                  <strong class="text-dark">Saldo</strong><br>
                  ${{ number_format($estacion->saldo,2) }}
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3">local_shipping</i>
                  </div>
                </div>
                <div class="col-7 col-sm-7">
                  <strong class="text-dark">Pedidos autorizados</strong><br>
                  {{ count($estacion->orders->where('status_id', '5')) }}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  

<div class="row">
  <div class="col-lg-6 col-md-12">
      <div class="card card-tasks">
          <div class="card-header">
              <h4 class="card-title">Historial de precios de combustible</h4>
              <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#pablo">Action</a>
                      <a class="dropdown-item" href="#pablo">Another action</a>
                      <a class="dropdown-item" href="#pablo">Something else</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <div class="table-full-width table-responsive">
                <table cellspacing="0" class="table tablesorter" id="datatables_1" width="100%">
                  <thead class="text-primary">
                    <th class="mr-5 ml-5">Extra</th>
                    <th>Supreme</th>
                    <th>Diesel</th>
                    <th>Fecha</th>
                  </thead>
                  <tbody>
                    @foreach($estacion->prices as $price)
                    <tr>
                      <td>{{ $price->extra }}</td>
                      <td>{{ $price->supreme }}</td>
                      <td>{{ $price->diesel }}</td>
                      <td>{{ $price->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>

  <div class="col-lg-6 col-md-12">
      <div class="card card-tasks">
          <div class="card-header">
              <h4 class="card-title">Historial de ordenes concluidas</h4>
              <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#pablo">Action</a>
                      <a class="dropdown-item" href="#pablo">Another action</a>
                      <a class="dropdown-item" href="#pablo">Something else</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <div class="table-full-width table-responsive">
                <table cellspacing="0" class="table" id="datatables_2" width="100%">
                  <thead class="text-primary">
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Costo Aprox</th>
                    <th>Fecha</th>
                  </thead>
                  <tbody>
                    @foreach($estacion->orders as $order)
                      @if($order->status_id == 5)
                        <tr>
                          <td>{{ $order->producto }}</td>
                          <td>{{ number_format($order->cantidad_lts,0) }}L</td>
                          <td>${{ number_format($order->costo_aprox, 2) }}</td>
                          <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
  
  <div class="col-lg-6 col-md-12">
    <div class="card ">
      <div class="card-header">
          <h4 class="card-title">Lista de usuarios</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            <table cellspacing="0" class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" id="datatables_3" width="100%">
              <thead class="text-primary">
                <th>Nombre</th>
                <th>Email</th>
                <th>Activo</th>
                <th>Fecha de Alta</th>
              </thead>
              <tbody>
                @foreach($estacion->users as $user)
                <tr>
                  <td>{{ $user->name }} {{ $user->app_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                  @if($estacion->linea_credito == 1)
                    Activo
                  @else
                    Inactivo
                  @endif
                  </td>
                  <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
    <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script>
    <script>
        
        function initDashboardPageCharts() {

            gradientChartOptionsConfigurationWithTooltipPurple = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(29,140,248,0.0)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    suggestedMin: 60,
                    suggestedMax: 125,
                    padding: 20,
                    fontColor: "#9a9a9a"
                }
                }],

                xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(225,78,202,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    padding: 20,
                    fontColor: "#9a9a9a"
                }
                }]
            }
            };

            var chart_labels = @json($meses);
            var chart_data = @json($extra);


            var ctx = document.getElementById("chartBig1").getContext('2d');

            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(25, 25, 252,0.3)');
            gradientStroke.addColorStop(0.4, 'rgba(25, 25, 252,0)');
            gradientStroke.addColorStop(0, 'rgba(25, 25, 252,0)'); //purple colors
            var config = {
            type: 'line',
            data: {
                labels: chart_labels,
                datasets: [{
                label: "Litros consumidos en el mes",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#1d8cf8',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#0051b5',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d346b1',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data,
                }]
            },
            options: gradientChartOptionsConfigurationWithTooltipPurple
            };

            var myChartData = new Chart(ctx, config);
            $("#0").click(function() {
              var data = myChartData.config.data;
              data.datasets[0].data = chart_data;
              data.datasets[0].borderColor = '#1d8cf8';
              data.datasets[0].pointBackgroundColor = '#0051b5';
              data.labels = chart_labels;
              myChartData.update();
            });

            $("#1").click(function() {
              var chart_data = @json($supreme);
              var data = myChartData.config.data;
              data.datasets[0].data = chart_data;
              data.datasets[0].borderColor = '#DF0632';
              data.datasets[0].pointBackgroundColor = '#ff0034';
              data.labels = chart_labels;
              myChartData.update();
            });

            $("#2").click(function() {
              var chart_data = @json($diesel);
              var data = myChartData.config.data;
              data.datasets[0].data = chart_data;
              data.datasets[0].borderColor = '#403e3f';
              data.datasets[0].pointBackgroundColor = '#0a0a0a';
              data.labels = chart_labels;
              myChartData.update();
            });


          }

        $(document).ready(function() {
          initDashboardPageCharts();
        });
    </script>
@endpush


@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ventas Totales</h4>
                                    <h4 class="text-dark title">{{ $order_totales }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Estaciones Registradas</h4>
                                    <h4 class="text-dark title">{{ $estacion_total }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Abonos Solicitados</h4>
                                    <h4 class="text-dark title">
                                        {{ $abonos_pendientes }}
                                        <a href="{{ route('abonos.index') }}">
                                            <span class="badge badge-info ml-3">Autorizar</span>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-chart">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <h2 class="card-title">VENTAS TOTALES</h2>
                                </div>
                                <div class="col-sm-6">
                                    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                    <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                        <input type="radio" name="options" checked>
                                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Extra</span>
                                        <span class="d-block d-sm-none">
                                            <i class="tim-icons icon-single-02"></i>
                                        </span>
                                    </label>
                                    <label class="btn btn-sm btn-primary btn-simple" id="1">
                                        <input type="radio" class="d-none d-sm-none" name="options">
                                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Supreme</span>
                                        <span class="d-block d-sm-none">
                                            <i class="tim-icons icon-gift-2"></i>
                                        </span>
                                    </label>
                                    <label class="btn btn-sm btn-primary btn-simple" id="2">
                                        <input type="radio" class="d-none" name="options">
                                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Diésel</span>
                                        <span class="d-block d-sm-none">
                                            <i class="tim-icons icon-tap-02"></i>
                                        </span>
                                    </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-4">
                            <div class="chart-area ">
                                <canvas id="chartBig1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h3 class="title d-inline">Estaciones</h3>
                    <!--div class="dropdown">
                        <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                            <i class="tim-icons icon-settings-gear-63"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#pablo">Action</a>
                            <a class="dropdown-item" href="#pablo">Another action</a>
                            <a class="dropdown-item" href="#pablo">Something else</a>
                        </div>
                    </div-->
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach($estaciones_info as $estacion_1)
                                <tr>
                                    <td>
                                        <p class="title">{{ $estacion_1->nombre_sucursal }}</p>
                                        <p class="text-muted">Saldo ${{ number_format($estacion_1->saldo, 2) }}</p>
                                        <p class="text-muted">Credito ${{ number_format($estacion_1->credito, 2) }}</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a class="btn btn-danger btn-link" data-original-title=""
                                            href="{{ route('estaciones.show', $estacion_1) }}" rel="tooltip"
                                            title="Ver información de la estación">
                                            <i class="tim-icons icon-minimal-right"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">ESTACIONES CON MÁS COMPRAS</h5>
                    <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <h5 class="card-category">Historial de precios</h5>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table  table-sm table-striped table-no-bordered table-hover" cellspacing="0" width="100%" id="datatables_1">
                            <thead class="text-primary">
                                <th>{{ __('Fecha') }}</th>
                                <th>{{ __('Nombre Sucursal') }}</th>
                                <th>{{ __('Extra') }}</th>
                                <th>{{ __('Supreme') }}</th>
                                <th>{{ __('Diesel') }}</th>
                            </thead>
                            <tbody>
                                @foreach ( $precios_actuales_estaciones as $precio_actual_estacion )
                                    <tr>
                                        <td>{{ $precio_actual_estacion->fecha }}</td>
                                        <td>{{ $precio_actual_estacion->nombre_sucursal }}</td>
                                        <td>{{ $precio_actual_estacion->extra }}</td>
                                        <td>{{ $precio_actual_estacion->supreme }}</td>
                                        <td>{{ $precio_actual_estacion->diesel }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4 d-none">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Total Shipments</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-none">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Completed Tasks</h5>
                    <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
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

            gradientChartOptionsConfigurationWithTooltipBlue = {
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
                    fontColor: "#2380f7"
                }
                }],

                xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(29,140,248,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    padding: 20,
                    fontColor: "#2380f7"
                }
                }]
            }
            };

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

            gradientChartOptionsConfigurationWithTooltipOrange = {
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
                    suggestedMin: 50,
                    suggestedMax: 110,
                    padding: 20,
                    fontColor: "#ff8a76"
                }
                }],

                xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(220,53,69,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    padding: 20,
                    fontColor: "#ff8a76"
                }
                }]
            }
            };

            gradientChartOptionsConfigurationWithTooltipGreen = {
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
                    suggestedMin: 50,
                    suggestedMax: 125,
                    padding: 20,
                    fontColor: "#9e9e9e"
                }
                }],

                xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(0,242,195,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    padding: 20,
                    fontColor: "#9e9e9e"
                }
                }]
            }
            };


            gradientBarChartConfiguration = {
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

                gridLines: {
                    drawBorder: false,
                    color: 'rgba(29,140,248,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    suggestedMin: 60,
                    suggestedMax: 120,
                    padding: 20,
                    fontColor: "#9e9e9e"
                }
                }],

                xAxes: [{

                gridLines: {
                    drawBorder: false,
                    color: 'rgba(29,140,248,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    padding: 20,
                    fontColor: "#9e9e9e"
                }
                }]
            }
            };

            var ctx = document.getElementById("chartLinePurple").getContext("2d");

            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(25, 25, 252,0.2)');
            gradientStroke.addColorStop(0.2, 'rgba(25, 25, 252,0.0)');
            gradientStroke.addColorStop(0, 'rgba(25, 25, 252,0)'); //purple colors

            /*var data = {
            labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                label: "Data",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: [80, 100, 70, 80, 120, 80],
            }]
            };

            var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipPurple
            });*/


            var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");

            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
            gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
            gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors

            var data = {
            labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV'],
            datasets: [{
                label: "My First dataset",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#00d6b4',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#00d6b4',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#00d6b4',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: [90, 27, 60, 12, 80],
            }]
            };

            var myChart = new Chart(ctxGreen, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipGreen

            });



            var chart_labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
            var chart_data = [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100];


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
                label: "My First dataset",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#171ae6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#050785',
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
            data.labels = chart_labels;
            myChartData.update();
            });
            $("#1").click(function() {
            var chart_data = [80, 120, 105, 110, 95, 105, 90, 100, 80, 95, 70, 120];
            var data = myChartData.config.data;
            data.datasets[0].data = chart_data;
            data.labels = chart_labels;
            myChartData.update();
            });

            $("#2").click(function() {
            var chart_data = [60, 80, 65, 130, 80, 105, 90, 130, 70, 115, 60, 130];
            var data = myChartData.config.data;
            data.datasets[0].data = chart_data;
            data.labels = chart_labels;
            myChartData.update();
            });


            var ctx = document.getElementById("CountryChart").getContext("2d");

            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
            gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
            gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


            var myChart = new Chart(ctx, {
            type: 'bar',
            responsive: true,
            legend: {
                display: false
            },
            data: {
                labels: ['USA', 'GER', 'AUS', 'UK', 'RO', 'BR'],
                datasets: [{
                label: "Countries",
                fill: true,
                backgroundColor: gradientStroke,
                hoverBackgroundColor: gradientStroke,
                borderColor: '#1f8ef1',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                data: [53, 20, 10, 80, 100, 45],
                }]
            },
            options: gradientBarChartConfiguration
            });

            }

        $(document).ready(function() {
          initDashboardPageCharts();
        });
    </script>
@endpush

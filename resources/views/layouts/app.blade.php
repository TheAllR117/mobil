<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('Mobil', 'Mobil Dashboard') }}</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('white') }}/img/apple-icon.png">
        <link rel="icon" type="image/png" href="{{ asset('white') }}/img/favicon.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('white') }}/css/nucleo-icons.css" rel="stylesheet" />
        <!-- CSS -->
        <link href="{{ asset('white') }}/css/white-dashboard.css?v=2.1.2" rel="stylesheet" />
        <link href="{{ asset('white') }}/css/theme.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    </head>
    <body class="white-content {{ $class ?? '' }} sidebar-mini">
        @auth()
            <div class="wrapper">
                    @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.navbar')

                    <div class="content">
                        @yield('content')
                    </div>

                    @include('layouts.footer')
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            @include('layouts.navbars.navbar')
            <div class="wrapper wrapper-full-page">
                <div class="full-page {{ $contentClass ?? '' }}" @if($contentClass == 'login-page') style="background-image: url('{{ asset('material') }}/img/login.jpg'); background-size: cover; background-position: top center;align-items: center;" @endif>
                    <div class="content">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        @endauth
        
        <script src="{{ asset('white') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('white') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('white') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

        <!-- Plugin for the momentJs  -->
        <script src="{{ asset('white') }}/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="{{ asset('white') }}/js/plugins/sweetalert2.js"></script>

        <!-- Forms Validations Plugin -->
        <script src="{{ asset('white') }}/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="{{ asset('white') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="{{ asset('white') }}/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="{{ asset('white') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="{{ asset('white') }}/js/plugins/jquery.dataTables.min.js"></script>
        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="{{ asset('white') }}/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="{{ asset('white') }}/js/plugins/jasny-bootstrap.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="{{ asset('white') }}/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="{{ asset('white') }}/js/plugins/jquery-jvectormap.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="{{ asset('white') }}/js/plugins/nouislider.min.js"></script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <script src="{{ asset('white') }}/js/plugins/arrive.min.js"></script>

        <!--  Google Maps Plugin    -->
        <!-- Place this tag in your head or just before your close body tag. -->
        {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
        <!-- Chart JS -->
        {{-- <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script> --}}
        <!--  Notifications Plugin    -->
        <script src="{{ asset('white') }}/js/plugins/bootstrap-notify.js"></script>

        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('white') }}/js/white-dashboard.js?v=2.1.1" type="text/javascript"></script>

        
        <script src="{{ asset('white') }}/js/theme.js"></script>
        <script src="{{ asset('white') }}/js/settings.js"></script>
      
        <script src="{{ asset('js') }}/cotizador.js"></script>
        <script src="{{ asset('js') }}/DateComponent.js"></script>
        <script src="{{ asset('js') }}/tabla_inicializador.js"></script>
        <script src="{{ asset('js') }}/precios_combustible.js"></script>
        <script src="{{ asset('js') }}/arrastrar.js"></script>

        @stack('js')

        <script>
            // funciones para la pagina de pedidos

            $("#input-pdf").change(function() {
                if($( "#input-pdf" ).val() != ""){
                    $("#archivo_pdf_boton").prop('disabled', false);
                } else {
                    $("#archivo_pdf_boton").prop('disabled', true);
                }
            });

            // funciones de la pagina estaciones--------------------------
            $("#input-excel").change(function() {
                if($("#input-excel").val() != ""){
                    $("#archivo_excel_boton").prop('disabled', false);
                } else {
                    $("#archivo_excel_boton").prop('disabled', true);
                }
            });

            $("#btn_archivo_excel").click(function() {
                alert('hola');
                if($( "#archivo_excel" ).val() != ""){
                    $("#archivo_excel_boton").prop('disabled', false);
                } else {
                    $("#archivo_excel_boton").prop('disabled', true);
                }
            });

            $(".btn-info").click(function() {
                //data-toggle="modal" data-target="#exampleModal"
                $('#exampleModal').modal('toggle');

                $('#exampleModal').on('hidden.bs.modal', function (e) {
                    $("#input-extra").val('0');
                    $("#input-supreme").val('0');
                    $("#input-diesel").val('0');

                    $("#input-extra_1").val('0');
                    $("#input-supreme_1").val('0');
                    $("#input-diesel_1").val('0');
                })
                //console.log('hola');
                suma_adictivo('input-extra','input-extra_1','utilidad_r');
                suma_adictivo('input-supreme','input-supreme_1','utilidad_p');
                suma_adictivo('input-diesel','input-diesel_1','utilidad_d');
            });


            $('#guardar_price').click(function(){
                $.ajax({
                    url: 'precio/store',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                    '_token': $('input[name=_token]').val(),
                    'id_estacion' : $("#id").val(),
                    'extra': $("#input-extra").val(),
                    'supreme': $("#input-supreme").val(),
                    'diesel': $("#input-diesel").val(),
                    'extra_u': $("#input-extra_1").val(),
                    'supreme_u': $("#input-supreme_1").val(),
                    'diesel_u': $("#input-diesel_1").val(),
                    },
                    headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                    $('#exampleModal').modal('toggle');
                    alert(response);
                    }
                });
            });

            
            $(document).ready(function() {
                $().ready(function() {
                    //
                    iniciar_selector_de_archivos();
                    // tables inician aqui
                    iniciar_date('datatables_1');
                    iniciar_date('datatables_2');
                    iniciar_date('datatables_3');
                    iniciar_date('datatables_4');
                    iniciar_date('datatables_5');

                    $sidebar = $('.sidebar');
                    $navbar = $('.navbar');
                    $main_panel = $('.main-panel');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');
                    sidebar_mini_active = true;
                    white_color = false;

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    $('.fixed-plugin a').click(function(event) {
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .background-color span').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data', new_color);
                        }

                        if ($main_panel.length != 0) {
                            $main_panel.attr('data', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data', new_color);
                        }
                    });

                    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);

                        if (sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            sidebar_mini_active = false;
                            whiteDashboard.showSidebarMessage('Sidebar mini deactivated...');
                        } else {
                            $('body').addClass('sidebar-mini');
                            sidebar_mini_active = true;
                            whiteDashboard.showSidebarMessage('Sidebar mini activated...');
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);
                    });

                    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                            var $btn = $(this);

                            if (white_color == true) {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').removeClass('white-content');
                                }, 900);
                                white_color = false;
                            } else {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').addClass('white-content');
                                }, 900);

                                white_color = true;
                            }
                    });

                    $('.light-badge').click(function() {
                        $('body').addClass('white-content');
                    });

                    $('.dark-badge').click(function() {
                        $('body').removeClass('white-content');
                    });
                });
            });
        </script>
        @stack('js')
    </body>
</html>

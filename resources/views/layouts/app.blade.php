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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
        <script src="{{ asset('white') }}/js/white-dashboard.js?v=1.0.0" type="text/javascript"></script>
        
        <script src="{{ asset('white') }}/js/plugins/bootstrap-switch.js"></script>
        <script src="{{ asset('white') }}/jsjs/plugins/jquery.tablesorter.js"></script>
        
        <script src="{{ asset('white') }}/js/theme.js"></script>
        <script src="{{ asset('white') }}/js/settings.js"></script>
      
        <script src="{{ asset('js') }}/cotizador.js"></script>
        <script src="{{ asset('js') }}/DateComponent.js"></script>
        <script src="{{ asset('js') }}/tabla_inicializador.js"></script>
        <script src="{{ asset('js') }}/precios_combustible.js"></script>
        <script src="{{ asset('js') }}/arrastrar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

        @stack('js')

        <script>

        
            // funciones para la pagina de solicitar pedidos
            
            $('#input-estacion_id').change(function(){
                $.ajax({
                    url: 'seleccionado',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'id' : $('#input-estacion_id').val(),
                    },
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var datos =  response;
                        $('#input-saldo').val(datos.estacion.saldo);
                        $('#input-saldo1').val(datos.estacion.saldo);
                        $('#input-credito').val(datos.estacion.credito);
                        $('#input-disponible').val(dividir( multiplicar(datos.estacion.credito) - multiplicar(datos.estacion.credito_usado) ));
                        // $('#precio_producto_extra').val(datos.price[datos.price.length - 1].extra_u);
                        // $('#precio_producto_supreme').val(datos.price[datos.price.length - 1].supreme_u);
                        // $('#precio_producto_diesel').val(datos.price[datos.price.length - 1].diesel_u);
                        $('#input-credito_usado').val(0);
                        $('#input-costo_aprox').val(0);

                        if(datos.valores_ultima_actualizacion != null)
                        {
                            document.getElementById('col-actualizacion').style.display = "block";
                            $('#span-fecha-ultima-actualizacion').text(datos.valores_ultima_actualizacion.fecha);

                            $('#precio_producto_extra').val(datos.valores_ultima_actualizacion.extra_u);
                            $('#precio_producto_supreme').val(datos.valores_ultima_actualizacion.supreme_u);
                            $('#precio_producto_diesel').val(datos.valores_ultima_actualizacion.diesel_u);

                        }else{
                            $('#precio_producto_extra').val(datos.price[datos.price.length - 1].extra_u);
                            $('#precio_producto_supreme').val(datos.price[datos.price.length - 1].supreme_u);
                            $('#precio_producto_diesel').val(datos.price[datos.price.length - 1].diesel_u);
                        }

                        if(datos.hay_adeudo === 1)
                        {
                            document.getElementById('btn-guardar-div').style.display = "none";
                            demo.showNotification('top','center', 'La estación tiene un adeudo que no ha pagado y ya expiró el plazo de pago.', 'tim-icons icon-bell-55');
                            // alert('La estaci贸n tiene un adeudo que no ha pagado y ya expir贸 el plazo de pago.');
                        }else{
                            document.getElementById('btn-guardar-div').style.display = "block";
                        }
                    }
                })
            });

            function costo_aprox(){
                if ($('#input-producto').val() == 'Extra') {

                $('#input-costo_aprox').val( dividir(dividir(multiplicar($('#precio_producto_extra').val()) * multiplicar( $('#input-cantidad_lts').val()))) );

                } else if( $('#input-producto').val() == 'Supreme' ) {

                $('#input-costo_aprox').val( dividir(dividir(multiplicar($('#precio_producto_supreme').val()) * multiplicar( $('#input-cantidad_lts').val()))) );


                } else if( $('#input-producto').val() == 'Diesel' ) {
                //alert(dividir(multiplicar($('#precio_producto_diesel').val()) * multiplicar( $('#input-cantidad_lts').val())) );
                $('#input-costo_aprox').val( dividir(dividir(multiplicar($('#precio_producto_diesel').val()) * multiplicar( $('#input-cantidad_lts').val()))) );

                }

            }

            $('.sele').change(function(){

                $('#input-credito_usado').val(0);
                $('#input-saldo1').val($('#input-saldo').val());
                $('#input-costo_aprox').val(0);

                costo_aprox();

            if(parseFloat($('#input-saldo').val()) > 0 ) {
                //hay saldo

                if(parseFloat($('#input-costo_aprox').val()) <= parseFloat($('#input-saldo').val())){

                    // alert('se puede comprar con el saldo.');
                    demo.showNotification('top','center', 'Se puede comprar con el saldo.', 'tim-icons icon-bell-55');
                    $('#input-saldo1').val($('#input-saldo').val() - $('#input-costo_aprox').val());
                    $('#input-credito_usado').val($('#input-disponible').val());
                    // $("#guardar").removeClass("ocultar");

                }else{
                    //el saldo no es suficiente

                    //alert('hola');

                    if(parseFloat($('#input-disponible').val()) >= 0 ){
                    //se usara saldo y credito
                    var suma_disponible_saldo = dividir( multiplicar(parseFloat($('#input-disponible').val())) + multiplicar(parseFloat($('#input-saldo').val())));
                    var costo_apro = dividir(multiplicar(parseFloat( $('#input-costo_aprox').val())));

                    if(suma_disponible_saldo >= costo_apro) {
                        demo.showNotification('top','center', 'credito y saldo suficientes para comprar.', 'tim-icons icon-bell-55');
                        //alert('credito y saldo suficientes para comprar');
                        $('#input-saldo1').val(0);

                        $('#input-credito_usado').val(dividir( multiplicar(suma_disponible_saldo) - multiplicar($('#input-costo_aprox').val())) ) ;
                        // $("#guardar").removeClass("ocultar");

                    }else{

                        $('#input-saldo1').val($('#input-saldo').val());

                        // alert('credito y saldo insuficientes para realizar la comprar');
                        demo.showNotification('top','center', 'credito y saldo insuficientes para realizar la compra.', 'tim-icons icon-bell-55');
                        // $("#guardar").addClass("ocultar");
                    }

                    }else{

                        // alert('credito insuficientes para comprar');
                        demo.showNotification('top','center','credito insuficientes para comprar', 'tim-icons icon-bell-55');
                        // $("#guardar").addClass("ocultar");

                    }

                }



            }else{
                //no hay saldo
                //determinar si hay credito disponible suficiente
                if(parseFloat($('#input-disponible').val()) != 0 && parseFloat($('#input-disponible').val()) >= 100000){

                    if(parseFloat($('#input-disponible').val()) > parseFloat( $('#input-costo_aprox').val())) {

                        //alert('no hay saldo pero si credito suficiente');
                        demo.showNotification('top', 'center','no hay saldo pero si credito suficiente', 'tim-icons icon-bell-55');
                        $('#input-credito_usado').val(dividir( multiplicar($('#input-disponible').val()) - multiplicar($('#input-costo_aprox').val())) ) ;
                        // $("#guardar").removeClass("ocultar");

                    }else{

                        //alert('credito insuficiente');
                        demo.showNotification('top','center','credito insuficiente', 'tim-icons icon-bell-55');
                        // $("#guardar").addClass("ocultar");

                    }

                } else {
                    document.getElementById('btn-guardar-div').style.display = "none";
                    demo.showNotification('top','center', 'Excediste tu linea de credito.', 'tim-icons icon-bell-55');
                    // $("#guardar").addClass("ocultar");
                }

            }

            });

            $('#input-estacion_id, #input-cantidad_lts, #input-producto').change(function(){
                if($("#input-credito_usado").val() == 0 && $("#input-costo_aprox").val() == 0){
                    $("#guardar").addClass("d-none");
                } 
                else if($("#input-saldo1").val() == 0 && $("#input-costo_aprox").val() == 0) 
                {
                    $("#guardar").addClass("d-none");
                }
                else
                {
                    $("#guardar").removeClass("d-none");
                }
            
            });

            // funciones de la pagina abonos
            $('#guardar_so').click(function(){
                $.ajax({
                    url: 'abonos/sal_o_cre',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id_estacion' : $("#input-estacion_id").val(),
                        'cantidad' : $("#input-cantidad").val(),
                        'id': $("#input-id_order").val(),
                    },
                    headers:{ 
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function(response){
                        $('#exampleModal').modal('toggle');
                        //alert(response);
                        demo.showNotification('top','center', response, 'tim-icons icon-bell-55');
                        location.reload(true);
                    }
                });
            });
            // funcion para las notificaciones 
                @if (session('status'))
                    demo.showNotification('top','center', '{{ session('status') }}', 'tim-icons icon-bell-55');
                @endif
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
                // alert('hola');
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
                    demo.showNotification('top','center', response, 'tim-icons icon-bell-55');
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

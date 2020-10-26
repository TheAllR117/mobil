@extends('layouts.app', ['page' => __('Gestión de los pedidos'), 'pageSlug' => __('Pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                    <div class="card bg-danger">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-white">
                            <a href="{{ route('pedidos.index') }}" title="Regresar a la lista">
                                <i class="tim-icons icon-minimal-left text-white"></i>
                            </a>
                            {{ __('Armar Envio') }} {{--date("d/m/Y",strtotime($fecha))--}}
                            </h4>
                        </div>
                    </div>
                
                    <div class="card ">
                       
                        <div class="card-body">
                            <div class="row mb-5 justify-content-center">
                                <div class="col-sm-2">
                                    <label class="label-control">Fletera</label><br>
                                    <select class="selectpicker" data-live-search="true" id="input-fletera" data-width="100%" data-style="btn-danger">
                                        <option data-tokens="" value="">Selecciona una opcion </option>
                                        @foreach ($namefreights as $namefreight)
                                            @if ($namefreight->id == $idFreight)
                                                <option data-tokens="{{$namefreight->name}}" value="{{$namefreight->id}}" selected>{{$namefreight->name}}</option>    
                                            @else
                                                <option data-tokens="{{$namefreight->name}}" value="{{$namefreight->id}}">{{$namefreight->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Tractor</label><br>
                                    <select class="selectpicker" id="input-tractor_id" data-style="btn-danger" data-width="100%">
                                        <option value="">Selecciona una opción</option>
                                    </select>
                                </div> 
                                <div class="col-sm-2">
                                    <label class="label-control">Pipa</label><br>
                                    <select class="selectpicker" data-style="btn-danger" data-width="100%" id="input-pipa_id"  multiple name="pipa_id" title="Selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Conductor</label><br>
                                    <select class="selectpicker" data-live-search="true" data-style="btn-danger" data-width="100%" id="input-conductor_id">
                                        <option data-tokens="" value="">Selecciona una opcion </option>
                                        @foreach ($drivers as $driver)
                                            @if ($driver->id == $idConductor)
                                                <option data-tokens="{{$driver->name}}" value="{{$driver->id}}" selected>{{$driver->name}}</option>    
                                            @else
                                                <option data-tokens="{{$driver->name}}" value="{{$driver->id}}">{{$driver->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Terminal</label><br>
                                    <select class="selectpicker" data-live-search="true" data-style="btn-danger" data-width="100%" id="input-terminal_id">
                                        <option data-tokens="" value="">Selecciona una opcion </option>
                                        @foreach ($terminals as $terminal)
                                            @if ($terminal->id == $idTerminal)
                                                <option data-tokens="{{$terminal->razon_social}}" value="{{$terminal->id}}" selected>{{$terminal->razon_social}}</option>    
                                            @else
                                                <option data-tokens="{{$terminal->razon_social}}" value="{{$terminal->id}}">{{$terminal->razon_social}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header card-header-text card-header-primary">
                                            <div class="card-text">
                                                <h4 class="card-title">
                                                    Lista de Pedidos
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3 pr-0 ml-2">
                                                    SO Number
                                                </div>
                                                <div class="col-sm-2 pl-0">
                                                    Estación
                                                </div>
                                                <div class="col-sm-2 mr-0 ml-4">
                                                    Producto
                                                </div>
                                                <div class="col-sm-2">
                                                    LTS
                                                </div>
                                                <div class="col-md-2">
                                                    Fecha
                                                </div>
                                                            
                                            </div>
                                            <ul class="facet-list selectpicker" id="allFacets" style=" height: auto; min-height: 50px;">
                                                @foreach($orders as $key => $order)
                                                    @foreach($estaciones as $estacion ) 
                                                        @if($order->status_id == 2 && $order->estacion_id == $estacion->id)
                                                            
                                                            <li class="facet alert btn-danger mr-0 ml-0" style="margin-left: -2.6rem !important;" value="{{$order->cantidad_lts}}">
                                                                <div class="row">
                                                                    <div class="col-sm-3 pr-1 text-white">
                                                                        {{ $order->so_number }}
                                                                        <input type="hidden" name="{{$key}}" value="{{ $order->id }}">
                                                                    </div>
                                                                    <div class="col-sm-3 pr-0 pl-0 text-white">
                                                                         {{ $estacion->nombre_sucursal }}
                                                                    </div>
                                                                    <div class="col-sm-2 pr-0 pl-0 text-white">
                                                                        {{ $order->producto }}
                                                                    </div>
                                                                    <div class="col-sm-2 pr-0 pl-0 text-white">
                                                                        {{ number_format($order->cantidad_lts, 0) }}L
                                                                    </div>
                                                                    <div class="col-sm-2 pr-0 pl-0 text-white">
                                                                        {{ $order->dia_entrega }}
                                                                    </div>
                                                                
                                                                </div>
                                                                
                                                            </li>
                                                            
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">

                                        <form @if (count($orderControler)>0)
                                                action="{{ route('control.update') }}"
                                            @else
                                                action="{{ route('control.store') }}" 
                                            @endif 
                                                autocomplete="off" class="form-horizontal" method="post">
                                            @csrf
                                            @method('post')
                                            <div class="card-header card-header-text card-header-primary">
                                                <div class="card-text">
                                                    <h4 class="card-title">
                                                        Pedidos a enviar
                                                    </h4>
                                                </div>
                                                <input class="form-control" type="date" name="dia_entrega" id="dia_entrega" >

                                                <div class="d-inline-block" id="fecha_flete">
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-2 pr-0 ml-2 mr-3">
                                                        SO Number
                                                    </div>
                                                    <div class="col-sm-2 pl-0">
                                                        Estación
                                                    </div>
                                                    <div class="col-sm-2 mr-0 ml-2">
                                                        Producto
                                                    </div>
                                                    <div class="col-sm-2">
                                                        LTS
                                                    </div>
                                                    <div class="col-md-2">
                                                        Fecha
                                                    </div>
                                                                
                                                </div>
                                                <input type="hidden" name="id_freights" id="id_freights" value="">
                                                <input type="hidden" name="pipa_id" id="pipa_id" value="">
                                                <input type="hidden" name="tractor_id" id="tractor_id" value="">
                                                <input type="hidden" name="terminal_id" id="terminal_id" value="">
                                                <input type="hidden" name="id_chofer" id="id_chofer" value="">
                                                <input type="hidden" name="idOrderControler" id="idOrderControler" value="{{$idOrderControler}}">

                                                <ul class="facet-list ml-0" id="userFacets" name="ordenes[]"  ondrop="cambio()">
                                                    @if (count($orderControler)>0)
                                                        @foreach($orderControler as $key => $order)
                                                            @foreach($estaciones as $estacion ) 
                                                                @if($order->estacion_id == $estacion->id)
                                                                    @if(count($estacion->freights) < 1)
                                                                        <li class="facet alert btn-danger mr-0 ml-0" style="margin-left: -2.6rem !important;">
                                                                            <div class="row">
                                                                                <div class="col-md-2 pr-0 pl-1 text-white">
                                                                                    {{ $order->so_number }}
                                                                                    <input type="hidden" name="{{$key}}" value="{{ $order->id }}">
                                                                                </div>
                                                                                <div class="col-md-3 pr-0 pl-0 text-white">
                                                                                    {{ $estacion->nombre_sucursal }}
                                                                                </div>
                                                                                <div class="col-md-2 pr-0 pl-0 text-white">
                                                                                    {{ $order->producto }}
                                                                                </div>
                                                                                <div class="col-md-2 pr-0 pl-0 text-white">
                                                                                    {{ number_format($order->cantidad_lts, 0) }}L
                                                                                </div>
                                                                                <div class="col-md-2 pr-0 pl-0 text-white">
                                                                                    {{ $order->dia_entrega }}
                                                                                </div>
                                                                                <div class="col-md-1 pr-0 pl-0 text-white">
                                                                                    <i class="material-icons">close</i>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach                                                        
                                                    @endif
                                                </ul>
                                                <div class="card-footer ml-auto mr-auto">
                                                    <button type="submit" class="btn btn-primary ocultar" id="enviar">{{ __('Enviar') }}</button>
                                                </div>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
  <script>
     // funciones de crecion de fletes

            
     $(".selectpicker").change(function() {
                $("#pipa_id").val( $("#input-pipa_id").val());
                $("#tractor_id").val($("#input-tractor_id").val());
                $("#terminal_id").val($("#input-terminal_id").val());
                $("#id_chofer").val($("#input-conductor_id").val());
                visible($("#input-pipa_id").val(),$("#input-tractor_id").val(),$("#input-terminal_id").val(),$("#input-conductor_id").val(), $("#fletera").val());
            
            });

            function visible(val1,val2,val3,val4,val5){
                if(val1 != null && val2 != "" && val3 != "" && val4 != ""){
                    $("#enviar").removeClass("ocultar");
                }  
            }
            // LLamando la lista de fleteras
            if({{$idFreight ?? ''}} != -1){
                inputFletera($("#input-fletera").val())
            }
            $("#input-fletera").change(function() {
                inputFletera($("#input-fletera").val())
            });
            // LLamando la lista de tractores
            $("#input-tractor_id").change(function() {
                inputTractor($("#input-tractor_id").val())
            });

            $("#dia_entrega").blur(function() {
                var fecha = $("#dia_entrega").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'fletes_contador',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                    'dia_entrega' : $("#dia_entrega").val(),
                    },
                    success: function(response){
                    $("#fecha_flete").html('<p class="alert alert-danger">Hay '+response+' fletes programados para el: '+fecha+'</p>');
                    }
                });
            });
        
        function inputFletera(id){
                $.ajax({
                    url: "{{ route('control.seleccionar_tractor') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id_freights' : id,
                    },
                    headers:{ 
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function(response){

                        $('#input-tractor_id').children('option:not(:first)').remove();
                        console.log(response);
                        for(i=0; i<response.tractores.length; i++){
                            for(j=0;j<response.tractores[i].length;j++){
                                if(response.tractores[i][j].id == {{$idTractor ?? ''}}){
                                    $('#input-tractor_id').append('<option value="'+response.tractores[i][j].id+'" selected>'+response.tractores[i][j].tractor+' - '+response.tractores[i][j].placas+'</option>');
                                    inputTractor({{$idTractor ?? ''}})
                                }else{
                                    $('#input-tractor_id').append('<option value="'+response.tractores[i][j].id+'">'+response.tractores[i][j].tractor+' - '+response.tractores[i][j].placas+'</option>');
                                }
                            }  
                        }
                        $('#input-tractor_id').selectpicker('render');
                        $('#input-tractor_id').selectpicker('refresh');

                        //refresh select pipas
                        $('#input-pipa_id').children('option:not(:first)').remove();
                        $('#input-pipa_id').selectpicker('render');
                        $('#input-pipa_id').selectpicker('refresh');
                        $("#id_freights").val(response.id);
        
                    
                    },
                    error: function(error){
                        console.log('error de consulta');
                        $('#input-tractor_id').children('option:not(:first)').remove();
                        $('#input-tractor_id').selectpicker('render');
                        $('#input-tractor_id').selectpicker('refresh');

                        //refresh select pipas
                        $('#input-pipa_id').children().remove();
                        $('#input-pipa_id').selectpicker('render');
                        $('#input-pipa_id').selectpicker('refresh');
                        
                    }
                });

        }

        function inputTractor(id){
                $.ajax({
                    url: "{{ route('control.seleccionar_pipa') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                    '_token': $('input[name=_token]').val(),
                    'id_tractor' : id,
                    },
                    headers:{ 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function(response){
                        console.log(response);
                        $('#input-pipa_id').children().remove();
                        for(i=0; i<response.pipas.length; i++){
                            if(response.pipas[i].id == {{$idPipaUno ?? ''}}){
                                $('#input-pipa_id').append('<option value="'+response.pipas[i].id+'" selected>'+response.pipas[i].numero_economico+' - '+response.pipas[i].capacidad+'LTS</option>');
                            }else if(response.pipas[i].id == {{$idPipaDos ?? ''}}){
                                $('#input-pipa_id').append('<option value="'+response.pipas[i].id+'" selected>'+response.pipas[i].numero_economico+' - '+response.pipas[i].capacidad+'LTS</option>');
                            }else if(response.pipas[i].id == {{$idPipaTres ?? ''}}){
                                $('#input-pipa_id').append('<option value="'+response.pipas[i].id+'" selected>'+response.pipas[i].numero_economico+' - '+response.pipas[i].capacidad+'LTS</option>');
                            }
                            else{
                                $('#input-pipa_id').append('<option value="'+response.pipas[i].id+'">'+response.pipas[i].numero_economico+' - '+response.pipas[i].capacidad+'LTS</option>');
                            }                
                        }
                        $('#input-pipa_id').selectpicker('render');
                        $('#input-pipa_id').selectpicker('refresh');
                    }
                });
            }


    $(document).ready(function(){
        $("#userFacets").height($("#allFacets").height());
    });

  </script>
@endpush

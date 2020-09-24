@extends('layouts.app', ['activePage' => 'Pedidos', 'titlePage' => __('Gestión de los pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">
                                {{ __('Armar Envio') }} {{date("d/m/Y",strtotime($fecha))}}
                            </h4>
                            <p class="card-category">
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                              <div class="col-12 text-left">
                                <a href="{{ route('pedidos.index') }}" class="btn btn-social btn-just-icon btn-primary" title="Regresar a la lista">
                                    <i class="material-icons">arrow_back_ios</i>
                                </a>
                              </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-2">
                                    <label class="label-control">Fletera</label><br>
                                    <select class="selectpicker" data-live-search="true" id="input-fletera" data-width="100%" data-style="btn-danger">
                                        @if ($idFreight != -1)
                                            @foreach ($namefreights as $namefreight)
                                                @if ($namefreight->id == $idFreight)
                                                    <option  data-tokens="{{$namefreight->name}}" value="{{$namefreight->id}}">{{$namefreight->name}} </option>    
                                                    @break
                                                @endif
                                            @endforeach
                                        @else
                                            <option data-tokens="" value=""> Selecciona una opcion </option>
                                        @endif

                                        @foreach($namefreights as $namefreight)
                                            @if ($namefreight->id != $idFreight)
                                                <option data-tokens="{{$namefreight->name}}" value="{{$namefreight->id}}">{{$namefreight->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Tractor</label><br>
                                    <select class="selectpicker"  id="input-tractor_id" data-style="btn-danger" data-width="100%">
                                        @if ($idTractor != -1)
                                            @foreach ($tractores as $tractor)
                                                @if ($tractor->id == $idTractor)
                                                    <option value="{{$tractor->id}}">{{$tractor->tractor}} - {{$tractor->placas}}</option>    
                                                    @break
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="" selected>Selecciona una opción</option>
                                        @endif
                                    </select>
                                </div> 
                                <div class="col-sm-2">
                                    <label class="label-control">Pipa</label><br>
                                    <select class="selectpicker" data-style="btn-danger" data-width="100%" id="input-pipa_id"  multiple>
                                        @if ($idPipaUno == -1 && $idPipaDos == -1)
                                            <option value="">Selecciona una opción</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Conductor</label><br>
                                    <select class="selectpicker" data-live-search="true" data-style="btn-danger" data-width="100%" id="input-conductor_id">
                                        @if ($idConductor != -1)
                                            @foreach ($drivers as $driver)
                                                @if ($driver->id == $idConductor)
                                                    <option value="{{$driver->id}}"> {{$driver->name}} </option>
                                                    @break
                                                @endif
                                            @endforeach
                                        @else
                                            <option data-tokens="" value="">Selecciona una opción</option>
                                        @endif
                                        @foreach ($drivers as $driver)
                                            @if ($driver->id != $idConductor)
                                                <option value="{{$driver->id}}"> {{$driver->name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Terminal</label><br>
                                    <select class="selectpicker" data-live-search="true" data-style="btn-danger" data-width="100%" id="input-terminal_id">
                                        @if ($idTerminal != -1)
                                            @foreach ($terminals as $terminal)
                                                @if ($terminal->id == $idTerminal)
                                                    <option value="{{ $terminal->id }}" data-tokens="{{ $terminal->razon_social }}">{{ $terminal->razon_social }}</option>    
                                                    @break
                                                @endif
                                            @endforeach
                                        @else
                                            <option data-tokens="" value="">Selecciona una opción</option>
                                        @endif
                                        @foreach($terminals as $terminal)
                                            @if ($terminal->id != $idTerminal)
                                                <option value="{{ $terminal->id }}" data-tokens="{{ $terminal->razon_social }}">{{ $terminal->razon_social }}</option>
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
                                                <div class="col-md-2">
                                                    SO Number
                                                </div>
                                                <div class="col-md-3">
                                                    Estación
                                                </div>
                                                <div class="col-md-2">
                                                    Producto
                                                </div>
                                                <div class="col-md-2">
                                                    LTS
                                                </div>
                                                <div class="col-md-3">
                                                    Fecha de Pedido
                                                </div>
                                                            
                                            </div>
                                            <ul class="facet-list selectpicker" id="allFacets" style=" height: auto; min-height: 50px;">
                                                @foreach($orders as $key => $order)
                                                    @foreach($estaciones as $estacion ) 
                                                        @if($order->status_id == 2 && $order->estacion_id == $estacion->id)
                                                            
                                                            <li class="facet alert alert-danger mr-0 ml-0" style="margin-left: -2.6rem !important;">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        {{ $order->so_number }}
                                                                        <input type="hidden" name="{{$key}}" value="{{ $order->id }}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                         {{ $estacion->nombre_sucursal }}
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        {{ $order->producto }}
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        {{ number_format($order->cantidad_lts, 0) }}L
                                                                    </div>
                                                                    <div class="col-md-3">
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
                                                    <input class="form-control" type="date" name="dia_entrega" id="dia_entrega" value={{$fecha}}>

                                                    <div class="d-inline-block" id="fecha_flete">
                                                        
                                                    </div>
                                                
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        SO Number
                                                    </div>
                                                    <div class="col-md-3">
                                                        Estación
                                                    </div>
                                                    <div class="col-md-2">
                                                        Producto
                                                    </div>
                                                    <div class="col-md-2">
                                                        LTS
                                                    </div>
                                                    <div class="col-md-3">
                                                        Fecha de Pedido
                                                    </div>
                                                                
                                                </div>
                                                <input type="hidden" name="id_freights" id="id_freights" value="">
                                                <input type="hidden" name="pipa_id" id="pipa_id" value="">
                                                <input type="hidden" name="tractor_id" id="tractor_id" value="">
                                                <input type="hidden" name="terminal_id" id="terminal_id" value="">
                                                <input type="hidden" name="id_chofer" id="id_chofer" value="">
                                                <input type="hidden" name="idOrderControler" id="idOrderControler" value="{{$idOrderControler}}">

                                                <ul class="facet-list ml-0" id="userFacets" style=" height: auto; min-height: 41px;">
                                                    @if (count($orderControler)>0)
                                                        @foreach($orderControler as $key => $order)
                                                            @foreach($estaciones as $estacion ) 
                                                                @if($order->estacion_id == $estacion->id)
                                                                    @if(count($estacion->freights) < 1)
                                                                        <li class="facet alert alert-danger mr-0 ml-0" style="margin-left: -2.6rem !important;">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    {{ $order->so_number }}
                                                                                    <input type="hidden" name="{{$key}}" value="{{ $order->id }}">
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    {{ $estacion->nombre_sucursal }}
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    {{ $order->producto }}
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    {{ number_format($order->cantidad_lts, 0) }}L
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    {{ $order->dia_entrega }}
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

    $(".selectpicker").change(function() {
        $("#pipa_id").val( $("#input-pipa_id").val());
        $("#tractor_id").val($("#input-tractor_id").val());
        $("#terminal_id").val($("#input-terminal_id").val());
        $("#id_chofer").val($("#input-conductor_id").val());
        //$("#fletera").val($("#input-fletera").val());
        visible($("#input-pipa_id").val(),$("#input-tractor_id").val(),$("#input-terminal_id").val(),$("#input-conductor_id").val(), $("#fletera").val());
      
    });

    function visible(val1,val2,val3,val4,val5){
        if(val1 != null && val2 != "" && val3 != "" && val4 != ""){
            $("#enviar").removeClass("ocultar");
        }  
    }
    // LLamando la lista de fleteras
    if({{$idFreight}} != -1){
        inputFletera()
    }
    $("#input-fletera").change(function() {
        inputFletera()
    });
    // LLamando la lista de tractores
    if({{$idTractor}} != -1){
        inputTractor()
    }
    $("#input-tractor_id").change(function() {
        inputTractor()
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
   
   function inputFletera(){

        $.ajax({
            url: 'seleccionar_tractor',
            type: 'POST',
            dataType: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'id_freights' : $("#input-fletera").val(),
            },
            headers:{ 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response){

                $('#input-tractor_id').children('option:not(:first)').remove();
                console.log(response);
                for(i=0; i<response.tractores.length; i++){
                    for(j=0;j<response.tractores[i].length;j++){
                        if(response.tractores[i][j].id != {{$idTractor}}){
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
                console.log('no');
                $('#input-tractor_id').children('option:not(:first)').remove();
                $('#input-tractor_id').selectpicker('render');
                $('#input-tractor_id').selectpicker('refresh');

                //refresh select pipas
                $('#input-pipa_id').children('option:not(:first)').remove();
                $('#input-pipa_id').selectpicker('render');
                $('#input-pipa_id').selectpicker('refresh');
                
            }
        });
   }

   function inputTractor(){
        $.ajax({
            url: 'seleccionar_pipa',
            type: 'POST',
            dataType: 'json',
            data: {
              '_token': $('input[name=_token]').val(),
              'id_tractor' : $("#input-tractor_id").val(),
            },
            headers:{ 
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response){
                console.log(response);
              $('#input-pipa_id').children('option:not(:first)').remove();
            //   $('#input-conductor_id').children('option:not(:first)').remove();
              
              /* for(i=0; i<response.pipas.length; i++){
                for(j=0;j<response.pipas[i].length;j++){
                    //console.log(response[i][j]);
                    if(response.pipas[i][j].id == {{$idPipaUno}}){
                        $('#input-pipa_id').append('<option value="'+response.pipas[i][j].id+'" selected>'+response.pipas[i][j].numero_economico+' - '+response.pipas[i][j].capacidad+'LTS</option>');
                    }
                    if(response.pipas[i][j].id == {{$idPipaDos}}){
                        $('#input-pipa_id').append('<option value="'+response.pipas[i][j].id+'" selected>'+response.pipas[i][j].numero_economico+' - '+response.pipas[i][j].capacidad+'LTS</option>');
                    }
                    if (response.pipas[i][j].id != {{$idPipaUno}} && response.pipas[i][j].id != {{$idPipaDos}}) {
                        $('#input-pipa_id').append('<option value="'+response.pipas[i][j].id+'">'+response.pipas[i][j].numero_economico+' - '+response.pipas[i][j].capacidad+'LTS</option>');
                    }
                }  
              } */
              
              for(i=0; i<response.pipas.length; i++){
                $('#input-pipa_id').append('<option value="'+response.pipas[i].id+'">'+response.pipas[i].numero_economico+' - '+response.pipas[i].capacidad+'LTS</option>');
                    
                    //console.log(response[i][j]);
                    /* if(response.pipas[i][j].id == {{$idPipaUno}}){
                        $('#input-pipa_id').append('<option value="'+response.pipas[i][j].id+'" selected>'+response.pipas[i][j].numero_economico+' - '+response.pipas[i][j].capacidad+'LTS</option>');
                    }
                    if(response.pipas[i][j].id == {{$idPipaDos}}){
                        $('#input-pipa_id').append('<option value="'+response.pipas[i][j].id+'" selected>'+response.pipas[i][j].numero_economico+' - '+response.pipas[i][j].capacidad+'LTS</option>');
                    }
                    if (response.pipas[i][j].id != {{$idPipaUno}} && response.pipas[i][j].id != {{$idPipaDos}}) {
                        $('#input-pipa_id').append('<option value="'+response.pipas[i][j].id+'">'+response.pipas[i][j].numero_economico+' - '+response.pipas[i][j].capacidad+'LTS</option>');
                    } */
                    
                
              }
              /* for(i=0; i<response.conductores.length; i++){
                for(j=0;j<response.conductores[i].length;j++){
                    //console.log(response[i][j]);
                    if (response.conductores[i][j].id != {{$idConductor}}){
                        $('#input-conductor_id').append('<option value="'+response.conductores[i][j].id+'">'+response.conductores[i][j].name+'</option>');
                    }
                }  
              } */
              $('#input-pipa_id').selectpicker('render');
              $('#input-pipa_id').selectpicker('refresh');
            //   $('#input-conductor_id').selectpicker('render');
            //   $('#input-conductor_id').selectpicker('refresh');
            }
        });
    }

  </script>
@endpush

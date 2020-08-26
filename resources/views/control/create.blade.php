@extends('layouts.app', ['activePage' => 'Pedidos', 'titlePage' => __('Gestión de los pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">
                                {{ __('Armar Envio') }} {{$fecha}}
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
                                        <option data-tokens="" value="">Selecciona una opción</option>
                                        @foreach($namefreights as $namefreight)
                                        <option data-tokens="{{$namefreight->name}}" value="{{$namefreight->id}}">{{$namefreight->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Tractor</label><br>
                                    <select class="selectpicker"  id="input-tractor_id" data-style="btn-danger" data-width="100%">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Pipa</label><br>
                                    <select class="selectpicker" data-style="btn-danger" data-width="100%" id="input-pipa_id"  multiple>
                                         <option value="">Selecciona una opción</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Conductor</label><br>
                                    <select class="selectpicker" data-style="btn-danger" data-width="100%" id="input-conductor_id">
                                        <option data-tokens="" value="">Selecciona una opción</option>
                                        
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="label-control">Terminal</label><br>
                                    <select class="selectpicker" data-live-search="true" data-style="btn-danger" data-width="100%" id="input-terminal_id">
                                        <option data-tokens="" value="">Selecciona una opción</option>
                                        @foreach($terminals as $terminal)
                                        <option value="{{ $terminal->id }}" data-tokens="{{ $terminal->razon_social }}">{{ $terminal->razon_social }}</option>
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
                                                <div class="col-md-3">
                                                    SO Number
                                                </div>
                                                <div class="col-md-3">
                                                    Estación
                                                </div>
                                                <div class="col-md-3">
                                                    Producto
                                                </div>
                                                <div class="col-md-3">
                                                    LTS
                                                </div>
                                                            
                                            </div>
                                            <ul class="facet-list selectpicker" id="allFacets" style=" height: auto; min-height: 50px;">
                                                @foreach($orders as $key => $order)
                                                    @foreach($estaciones as $estacion ) 
                                                        @if($order->status_id == 2 && $order->estacion_id == $estacion->id)
                                                            @if(count($estacion->freights) < 1)
                                                            <li class="facet alert alert-danger mr-0 ml-0" style="margin-left: -2.6rem !important;">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        {{ $order->so_number }}
                                                                        <input type="hidden" name="{{$key}}" value="{{ $order->id }}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                         {{ $estacion->nombre_sucursal }}
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        {{ $order->producto }}
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        {{ number_format($order->cantidad_lts, 0) }}L
                                                                    </div>
                                                                
                                                                </div>
                                                                
                                                            </li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header card-header-text card-header-primary">
                                            <div class="card-text">
                                                <h4 class="card-title">
                                                    Pedidos a enviar
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    SO Number
                                                </div>
                                                <div class="col-md-3">
                                                    Estación
                                                </div>
                                                <div class="col-md-3">
                                                    Producto
                                                </div>
                                                <div class="col-md-3">
                                                    LTS
                                                </div>
                                                            
                                            </div>
                                            <form action="{{ route('control.store') }}" autocomplete="off" class="form-horizontal" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id_freights" id="id_freights" value="">
                                            <input type="hidden" name="pipa_id" id="pipa_id" value="">
                                            <input type="hidden" name="tractor_id" id="tractor_id" value="">
                                            <input type="hidden" name="terminal_id" id="terminal_id" value="">
                                            <input type="hidden" name="conductor_id" id="conductor_id" value="">
                                            

                                            <ul class="facet-list ml-0" id="userFacets" style=" height: auto; min-height: 41px;">
                                                
                                            </ul>
                                            <div class="card-footer ml-auto mr-auto">
                                                <button type="submit" class="btn btn-primary ocultar" id="enviar">{{ __('Enviar') }}</button>
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
</div>
@endsection

@push('js')
  <script>


    $(".selectpicker").change(function() {
        $("#pipa_id").val( $("#input-pipa_id").val());
        $("#tractor_id").val($("#input-tractor_id").val());
        $("#terminal_id").val($("#input-terminal_id").val());
        $("#conductor_id").val($("#input-conductor_id").val());
        //$("#fletera").val($("#input-fletera").val());
        visible($("#input-pipa_id").val(),$("#input-tractor_id").val(),$("#input-terminal_id").val(),$("#input-conductor_id").val(), $("#fletera").val());
      
    });

    function visible(val1,val2,val3,val4,val5){
        if(val1 != null && val2 != "" && val3 != "" && val4 != ""){
            $("#enviar").removeClass("ocultar");
        }  
    }

    $("#input-fletera").change(function() {

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
              
              for(i=0; i<response.tractores.length; i++){
                for(j=0;j<response.tractores[i].length;j++){
                    //console.log(response[i][j].id);
                    if(response.tractores[i][j].id_status == 1){
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
            }
        });
    });


    $("#input-tractor_id").change(function() {

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
              $('#input-conductor_id').children('option:not(:first)').remove();
              
              for(i=0; i<response.pipas.length; i++){
                for(j=0;j<response.pipas[i].length;j++){
                    //console.log(response[i][j]);
                    $('#input-pipa_id').append('<option value="'+response.pipas[i][j].id+'">'+response.pipas[i][j].numero+' - '+response.pipas[i][j].numero_economico+' - '+response.pipas[i][j].capacidad+'LTS</option>');
                }  
              }

              for(i=0; i<response.conductores.length; i++){
                for(j=0;j<response.conductores[i].length;j++){
                    //console.log(response[i][j]);
                    $('#input-conductor_id').append('<option value="'+response.conductores[i][j].id+'">'+response.conductores[i][j].name+'</option>');
                }  
              }
              $('#input-pipa_id').selectpicker('render');
              $('#input-pipa_id').selectpicker('refresh');

              $('#input-conductor_id').selectpicker('render');
              $('#input-conductor_id').selectpicker('refresh');
            }
        });
    });

   
  </script>
@endpush

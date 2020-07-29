@extends('layouts.app', ['activePage' => 'Pedidos', 'titlePage' => __('Gestión de los pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">
                                {{ __('Armar Envio') }}
                            </h4>
                            <p class="card-category">
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-3">
                                    <label class="label-control">Pipa  LTS</label>
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-pipa_id" name="pipa_id">
                                        <option disabled selected>-- Seleccionar --</option>
                                        @foreach($pipes as $pipe)
                                        <option value="{{ $pipe->id }}">{{ $pipe->numero_economico }} - {{ $pipe->capacidad }}LTS</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-3">
                                    <label class="label-control">Tractor</label>
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-tractor_id" name="pipa_id">
                                        <option disabled selected>-- Seleccionar --</option>
                                        @foreach($tractores as $tractor)
                                        <option value="{{ $tractor->id }}">{{ $tractor->tractor }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-3">
                                    <label class="label-control">Terminal</label>
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-terminal_id" name="pipa_id">
                                        <option disabled selected>-- Seleccionar --</option>
                                        @foreach($terminals as $terminal)
                                        <option value="{{ $terminal->id }}">{{ $terminal->razon_social }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-3">
                                    <label class="label-control">Conductor</label>
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-conductor_id" name="pipa_id">
                                        <option disabled selected>-- Seleccionar --</option>
                                        @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
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
                                            <form action="{{ route('pedidos.store_flete') }}" autocomplete="off" class="form-horizontal" method="post">
                                            @csrf
                                            @method('post')

                                            <input type="hidden" name="pipa_id" id="pipa_id" value="">
                                            <input type="hidden" name="tractor_id" id="tractor_id" value="">
                                            <input type="hidden" name="terminal_id" id="terminal_id" value="">
                                            <input type="hidden" name="conductor_id" id="conductor_id" value="">

                                            <ul class="facet-list ml-0" id="userFacets" style=" height: auto; min-height: 50px;">
                                                
                                            </ul>
                                            <div class="card-footer ml-auto mr-auto">
                                                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
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
      
    });

   
  </script>
@endpush

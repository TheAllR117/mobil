@extends('layouts.app', ['page' => __('Gestión de los pedidos'), 'pageSlug' => __('Pedidos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form action="{{ route('pedidos.store') }}" autocomplete="off" class="form-horizontal" method="post">
                  @csrf
                  @method('post')
                    <div class="card bg-blue">
                      <div class="card-header card-header-primary">
                        <h4 class="card-title text-white">
                          <a href="{{ route('pedidos.index') }}" title="Regresar a la lista">
                            <i class="tim-icons icon-minimal-left text-white"></i>
                          </a>
                          {{ __('Solicitar Pedido') }}
                        </h4>
                      </div>
                    </div>
                    <div class="card ">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6" id="col-actualizacion" style="display: none;">
                              <p>Precios actualizados <span id="span-fecha-ultima-actualizacion"></span></p>
                            </div>
                          </div>

                            <div class="row mt-4">
                            	<div class="col-lg-4 col-md-4 col-sm-4">
                                <label class="label-control">Estación</label><br>
                                <select class="selectpicker" data-style="btn btn-primary" data-live-search="true" data-width="100%"  id="input-estacion_id" name="estacion_id">
                                  <option disabled selected>-- Seleccionar --</option>
                                  @foreach($estaciones as $estacion)
                                    <option value="{{ $estacion->id }}">{{ $estacion->nombre_sucursal }}</option>
                                  @endforeach
                                </select>
                              </div>

                              	<input type="hidden" name="status_id" value="1">

                              	<div class="col-lg-4 col-md-4 col-sm-4 justify-content-center">
                              		<label class="label-control">Tipo de contenedor</label><br>
                                	<select class="selectpicker sele" data-style="btn btn-primary" data-width="100%" id="input-cantidad_lts" name="cantidad_lts">
                                      <option disabled selected>-- Seleccionar --</option>
                                      @for($i=0; $i<count($tem); $i++)
                                        <option value="{{$tem[$i]}}">{{number_format($tem[$i],0)}}Lts</option>
                                      @endfor
                                  		
                                	</select>
                              	</div>

                              	<div class="col-lg-4 col-md-4 col-sm-4">
                              		<label class="label-control">Producto</label><br>
                                	<select class="selectpicker sele" data-style="btn btn-primary" data-width="100%" id="input-producto" name="producto">
                                  		<option disabled selected>-- Seleccionar --</option>
                                  		<option value="Extra">Extra</option>
                                  		<option value="Supreme">Supreme</option>
                                  		<option value="Diesel">Diesel</option>
                                	</select>
                              	</div>

                            </div>

                            <div class="row mt-4">

                            	<div class="form-group col-sm-4">
                                	<label class="label-control">Fecha de entrega</label>
                                	<input class="form-control datetimepicker" id="input-dia_entrega" name="dia_entrega" type="text" value="" placeholder="Fecha">
                            	</div>

                            	<div class="form-group{{ $errors->has('saldo') ? ' has-danger' : '' }} col-sm-4">
                            		<input type="hidden" id="input-saldo" name="saldo" value="">

                                	<label for="saldo1">{{ __('Saldo actual') }}</label>
                                	<input aria-describedby="saldo1Help" aria-required="true" class="form-control{{ $errors->has('saldo1') ? ' is-invalid' : '' }}"  id="input-saldo1" name="saldo1"  type="number" min="0.00" step="0.01" value="{{ old('saldo1',0)}}" readonly>
                                  	@if ($errors->has('saldo1'))
                                    <span class="error text-danger" for="input-saldo1" id="saldo1-error">
                                      {{ $errors->first('saldo1') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                              	<div class="form-group{{ $errors->has('credito') ? ' has-danger' : '' }} col-sm-4">

                              		<input type="hidden" id="precio_producto_extra">
                              		<input type="hidden" id="precio_producto_supreme">
                              		<input type="hidden" id="precio_producto_diesel">

                                	<label for="credito">{{ __('Linea de credito') }}</label>
                                	<input aria-describedby="creditoHelp" aria-required="true" class="form-control{{ $errors->has('credito') ? ' is-invalid' : '' }}"  id="input-credito" name="credito"  type="number" min="0.00" step="0.01" value="{{ old('credito',0)}}" readonly>
                                  	@if ($errors->has('credito'))
                                    <span class="error text-danger" for="input-credito" id="credito-error">
                                      {{ $errors->first('credito') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                            </div>

                            <div class="row mt-4">
                            	<div class="form-group{{ $errors->has('disponible') ? ' has-danger' : '' }} col-sm-4">
                                	<label for="disponible">{{ __('Credito disponible') }}</label>
                                	<input aria-describedby="numero_economicoHelp" aria-required="true" class="form-control{{ $errors->has('disponible') ? ' is-invalid' : '' }}"  id="input-disponible" name="disponible" type="number" min="0.00" step="0.01" value="{{ old('disponible',0)}}" readonly>
                                  	@if ($errors->has('disponible'))
                                    <span class="error text-danger" for="input-disponible" id="disponible-error">
                                      {{ $errors->first('disponible') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                              	<div class="form-group{{ $errors->has('numero_economico') ? ' has-danger' : '' }} col-sm-4">
                                	<label for="credito_usado">{{ __('Credito restante') }}</label>
                                	<input aria-describedby="credito_usadoHelp"  aria-required="true" class="form-control{{ $errors->has('numero_economico') ? ' is-invalid' : '' }}" id="input-credito_usado" name="credito_usado" type="number" min="0.00" step="0.01" value="{{ old('credito_usado',0)}}" readonly>
                                  	@if ($errors->has('credito_usado'))
                                    <span class="error text-danger" for="input-credito_usado" id="credito_usado-error">
                                      {{ $errors->first('credito_usado') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                              	<div class="form-group{{ $errors->has('costo_aprox') ? ' has-danger' : '' }} col-sm-4">
                                	<label for="costo_aprox">{{ __('Costo aproximado') }}</label>
                                	<input aria-describedby="costo_aproxHelp" aria-required="true" class="form-control{{ $errors->has('costo_aprox') ? ' is-invalid' : '' }}" id="input-costo_aprox" name="costo_aprox" type="number" min="0.00" step="0.01" value="{{ old('costo_aprox', 0)}}" readonly>
                                  	@if ($errors->has('costo_aprox'))
                                    <span class="error text-danger" for="input-costo_aprox" id="costo_aprox-error">
                                      {{ $errors->first('costo_aprox') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>
                            </div>
                            {{-- <div class="row mt-4">
                              <div class="form-group{{ $errors->has('po') ? ' has-danger' : '' }} col-sm-3">
                                  <label for="po">{{ __('PO') }}</label>
                                  <input aria-describedby="poHelp" aria-required="true" class="form-control{{ $errors->has('po') ? ' is-invalid' : '' }}" id="input-po" name="po" type="text" value="{{ old('po')}}">
                                    @if ($errors->has('po'))
                                    <span class="error text-danger" for="input-po" id="po-error">
                                      {{ $errors->first('po') }}
                                    </span>
                                    @endif
                                  </input>
                                </div>
                            </div> --}}

                            <div class="card-footer ml-auto mr-auto" id="btn-guardar-div">
                                <button class="btn btn-primary d-none" type="submit" id="guardar">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
	    
  @if(auth()->user()->roles[0]->name == 'Administrador' || auth()->user()->roles[0]->name == 'Logistica')
    init_calendar('input-dia_entrega', now(), '07-07-2025');
  @else
    init_calendar('input-dia_entrega', manana(), '07-07-2025');
  @endif

</script>
@endpush

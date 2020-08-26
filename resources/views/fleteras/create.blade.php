@extends('layouts.app', ['activePage' => 'Fleteras', 'titlePage' => __('Gestión de Fleteras')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 mx-auto d-block mt-3">

        <form action="{{ route('fleteras.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
        	@csrf
        	@method('post')
          <div class="card ">

          	<div class="card-header card-header-primary">
			  <h4 class="card-title">
			      {{ __('Agregar Relación') }}
			  </h4>
			  <p class="card-category"></p>
			</div>

            <div class="card-body">
	            <div class="row">
		            <div class="col-12 text-left">
		              <a href="{{ route('fleteras.index') }}" class="btn btn-social btn-just-icon btn-primary" title="Regresar a la lista">
		                  <i class="material-icons">arrow_back_ios</i>
		              </a>
		            </div>
	            </div>

	            <div class="row">
	            	<div class="form-group{{ $errors->has('id_freights') ? ' has-danger' : '' }} mt-5 col-md-4">

	            		<label for="id_freights" class="">
	            			{{ __('Nombre de la fletera') }}
	            		</label>

	            		<select class="selectpicker show-tick show-menu-arrow bfh-languages" data-live-search="true" data-style="btn-danger" id="input-id_freights" data-language="es_MX" data-available="es_MX"  name="id_freights">
	            			<option data-tokens="Selecciona una fletera" value="">Selecciona una fletera</option>
	            			@foreach($freights as $freight)
	            			<option data-tokens="{{ $freight->name }}" value="{{ $freight->id }}">{{ $freight->name }}</option>
	            			@endforeach
						</select>
						<br>
						 @if ($errors->has('id_freights'))
		                    <span class="error text-danger" for="input-id_freights" id="id_freights-error">
		                      {{ $errors->first('id_freights') }}
		                    </span>
		                 @endif
	                </div>

	                <div class="form-group{{ $errors->has('id_estacion') ? ' has-danger' : '' }} mt-5 col-md-4">

	            		<label for="id_estacion" class="">
	            			{{ __('Estación') }}
	            		</label>

	            		<select class="selectpicker show-tick show-menu-arrow bfh-languages" data-live-search="true" data-style="btn-danger" id="input-id_estacion" data-language="es_MX" data-available="es_MX"  name="id_estacion">
	            			<option data-tokens="Selecciona una estación" value="">Selecciona una estación</option>
	            			@foreach($estacions as $estacion)
	            			<option data-tokens="{{ $estacion->nombre_sucursal }}" value="{{ $estacion->id }}">{{ $estacion->nombre_sucursal }}</option>
	            			@endforeach
						</select><br>
						 @if ($errors->has('id_estacion'))
		                    <span class="error text-danger" for="input-id_estacion" id="id_estacion-error">
		                      {{ $errors->first('id_estacion') }}
		                    </span>
		                 @endif
	                </div>

	                <div class="form-group{{ $errors->has('id_pipa') ? ' has-danger' : '' }} mt-5 col-md-4">

	            		<label for="id_pipa" class="">
	            			{{ __('Pipa') }}
	            		</label>

	            		<select class="selectpicker show-tick show-menu-arrow bfh-languages" data-live-search="true" data-style="btn-danger" id="input-id_pipa" data-language="es_MX" data-available="es_MX" name="id_pipa[]" multiple data-max-options="2">
	            			<option data-tokens="Selecciona una estación" value="">Selecciona una pipa</option>
	            			@foreach($pipes as $pipa)
	            			<option data-tokens="{{ $pipa->numero_economico }}" value="{{ $pipa->id }}">{{ $pipa->numero_economico }}</option>
	            			@endforeach
						</select><br>
						 @if ($errors->has('id_pipa'))
		                    <span class="error text-danger" for="input-id_pipa" id="id_pipa-error">
		                      {{ $errors->first('id_pipa') }}
		                    </span>
		                 @endif

	                </div>

	            </div>

	            <div class="row">
	            	<div class="form-group{{ $errors->has('id_tractor') ? ' has-danger' : '' }} mt-5 col-md-4">

	            		<label for="id_tractor" class="">
	            			{{ __('Tractor') }}
	            		</label>

	            		<select class="selectpicker show-tick show-menu-arrow bfh-languages" data-live-search="true" data-style="btn-danger" id="input-id_tractor" data-language="es_MX" data-available="es_MX"  name="id_tractor">
	            			<option data-tokens="Selecciona una estación" value="">Selecciona un tractor</option>
	            			@foreach($tractors as $tractor)
	            			<option data-tokens="{{ $tractor->tractor }}" value="{{ $tractor->id }}">{{ $tractor->tractor }}</option>
	            			@endforeach
						</select><br>
						 @if ($errors->has('id_tractor'))
		                    <span class="error text-danger" for="input-id_tractor" id="id_tractor-error">
		                      {{ $errors->first('id_tractor') }}
		                    </span>
		                 @endif
	                </div>

	                <div class="form-group{{ $errors->has('id_chofer') ? ' has-danger' : '' }} mt-5 col-md-4">

	            		<label for="id_chofer" class="">
	            			{{ __('Conductor') }}
	            		</label>

	            		<select class="selectpicker show-tick show-menu-arrow bfh-languages" data-live-search="true" data-style="btn-danger" id="input-id_chofer" data-language="es_MX" data-available="es_MX"  name="id_chofer">
	            			<option data-tokens="Selecciona una estación" value="">Selecciona un conductor</option>
	            			@foreach($drivers as $driver)
	            			<option value="{{ $driver->id }}" data-tokens="{{ $driver->name }}">{{ $driver->name }}</option>
	            			@endforeach
						</select><br>
						 @if ($errors->has('id_chofer'))
		                    <span class="error text-danger" for="input-id_chofer" id="id_chofer-error">
		                      {{ $errors->first('id_chofer') }}
		                    </span>
		                 @endif
	                </div>
	            </div>

	            <div class="card-footer ml-auto mr-auto">
	            	<button class="btn btn-primary" type="submit">
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
    $(document).ready(function(){
    	$('#select').selectpicker({ language: 'ES' });
    iniciar_selector_de_archivos();
  });
</script>
@endpush

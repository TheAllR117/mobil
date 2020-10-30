@extends('layouts.app', ['page' => __('Gestión de Fleteras'), 'pageSlug' => __('Fleteras')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto d-block mt-3">

        <form action="{{ route('fleteras.update', $fletera->id) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
        	@csrf
        	@method('post')
			<div class="card bg-blue">
				<div class="card-header card-header-primary">
					<h4 class="card-title text-white">
						<a href="{{ route('fleteras.index') }}" title="Regresar a la lista">
							<i class="tim-icons icon-minimal-left text-white"></i>
						</a>
						{{ __('Agregar Relación') }}
					</h4>
				</div>
			</div>
          <div class="card ">

            <div class="card-body">

	            <div class="row">
	            	<div class="form-group{{ $errors->has('id_freights') ? ' has-danger' : '' }} mt-5 col-md-6">

	            		<label for="id_freights" class="">
	            			{{ __('Nombre de la fletera') }}
	            		</label>
	            		<select class="selectpicker show-tick show-menu-arrow bfh-languages" data-live-search="true" data-style="btn-danger" id="input-id_freights" data-language="es_MX" data-available="es_MX"  name="id_freights">
	            			<option data-tokens="Selecciona una fletera" value="">Selecciona una fletera</option>
	            			@foreach($freights as $freight)
                                @if($fletera->id_freights == $freight->id)
	            			        <option data-tokens="{{ $freight->name }}" value="{{ $freight->id }}" selected>{{ $freight->name }}</option>
                                @else
                                    <option data-tokens="{{ $freight->name }}" value="{{ $freight->id }}" >{{ $freight->name }}</option>
                                @endif
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
                                @if($fletera->id_estacion == $estacion->id)
                                    <option data-tokens="{{ $estacion->nombre_sucursal }}" value="{{ $estacion->id }}" selected>{{ $estacion->nombre_sucursal }}</option>
                                @else
                                    <option data-tokens="{{ $estacion->nombre_sucursal }}" value="{{ $estacion->id }}">{{ $estacion->nombre_sucursal }}</option>
                                @endif
	            			@endforeach
						</select><br>
						 @if ($errors->has('id_estacion'))
		                    <span class="error text-danger" for="input-id_estacion" id="id_estacion-error">
		                      {{ $errors->first('id_estacion') }}
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
                                @if($fletera->id_tractor == $tractor->id)
	            			        <option data-tokens="{{ $tractor->tractor }}" value="{{ $tractor->id }}" selected>{{ $tractor->tractor }}</option>
                                @else
                                <option data-tokens="{{ $tractor->tractor }}" value="{{ $tractor->id }}">{{ $tractor->tractor }}</option>
                                @endif
	            			@endforeach
						</select><br>
						 @if ($errors->has('id_tractor'))
		                    <span class="error text-danger" for="input-id_tractor" id="id_tractor-error">
		                      {{ $errors->first('id_tractor') }}
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

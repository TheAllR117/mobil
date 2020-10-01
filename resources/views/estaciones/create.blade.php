@extends('layouts.app', ['page' => __('Gestión de Estaciones'), 'pageSlug' => __('Estaciones')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 mx-auto d-block mt-3">
          <form method="post" action="{{ route('estaciones.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">
					<a href="{{ route('estaciones.index') }}" title="Regresar a la lista">
                        <i class="tim-icons icon-minimal-left text-danger"></i>
                    </a>
					{{ __('Agregar estación') }}
				</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row mt-5">

                  <div class="form-group{{ $errors->has('razon_social') ? ' has-danger' : '' }} col-sm-4">
                    <label for="razon_social">{{ __('Razon social') }}</label>
                    <input type="text" class="form-control{{ $errors->has('razon_social') ? ' is-invalid' : '' }}" id="input-razon_social" aria-describedby="razon_socialHelp"  value="{{ old('razon_social')}}" aria-required="true" name="razon_social">
                    @if ($errors->has('razon_social'))
                      <span id="razon_social-error" class="error text-danger" for="input-razon_social">
                        {{ $errors->first('razon_social') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group{{ $errors->has('rfc') ? ' has-danger' : '' }} col-sm-4">
                    <label for="rfc">{{ __('RFC') }}</label>
                    <input type="text" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" name="rfc" id="input-rfc" value="{{ old('rfc','XEXX010101000') }}" aria-required="true" aria-describedby="rfcHelp" >
                    @if ($errors->has('rfc'))
                      <span id="rfc-error" class="error text-danger" for="input-rfc">
                        {{ $errors->first('rfc') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group{{ $errors->has('cre') ? ' has-danger' : '' }} col-sm-4">
                    <label for="cre">{{ __('CRE') }}</label>
                    <input type="text" class="form-control{{ $errors->has('cre') ? ' is-invalid' : '' }}" name="cre" id="input-cre" value="{{ old('cre') }}" aria-required="true" aria-describedby="creHelp"   >
                    @if ($errors->has('cre'))
                        <span id="cre-error" class="error text-danger" for="input-cre">{{ $errors->first('cre') }}</span>
                      @endif
                  </div>

                </div>

                <div class="row mt-2">

                	<div class="form-group{{ $errors->has('sh') ? ' has-danger' : '' }} col-sm-6">
                    	<label for="sh">{{ __('SH') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('sh') ? ' is-invalid' : '' }}" name="sh" id="input-sh" value="{{ old('sh') }}"aria-required="true" aria-describedby="shHelp">
                    	@if ($errors->has('sh'))
                      		<span id="sh-error" class="error text-danger" for="input-sh">
                        		{{ $errors->first('sh') }}
                      		</span>
                    	@endif
                  	</div>

              
                  	<div class="form-group{{ $errors->has('nombre_sucursal') ? ' has-danger' : '' }} col-sm-6">
                    	<label for="nombre_sucursal">{{ __('Nombre de la sucursal') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('nombre_sucursal') ? ' is-invalid' : '' }}" name="nombre_sucursal" id="input-nombre_sucursal" value="{{ old('nombre_sucursal') }}" aria-required="true" aria-describedby="nombre_sucursalHelp">
                    	@if ($errors->has('nombre_sucursal'))
                        	<span id="nombre_sucursal-error" class="error text-danger" for="input-nombre_sucursal">{{ $errors->first('nombre_sucursal') }}</span>
                      	@endif
                  	</div>
                </div>

                <div class="row mt-2">

                	<div class="form-group{{ $errors->has('flete_r') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="flete_r">{{ __('Flete R') }}</label>
                    	<input type="number" step="0.0001" min = "0" class="form-control{{ $errors->has('flete_r') ? ' is-invalid' : '' }}" name="flete_r" id="input-flete_r" value="{{ old('flete_r', 0) }}" aria-required="true" aria-describedby="flete_rHelp">
                    	@if ($errors->has('flete_r'))
                      		<span id="flete_r-error" class="error text-danger" for="input-flete_r">
                        		{{ $errors->first('flete_r') }}
                      		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('flete_p') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="flete_p">{{ __('Flete P') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('flete_p') ? ' is-invalid' : '' }}" name="flete_p" id="input-flete_p" step="0.0001" min = "0" value="{{ old('flete_p', 0) }}" aria-required="true" aria-describedby="flete_dHelp">
                    	@if ($errors->has('flete_p'))
                      		<span id="flete_p-error" class="error text-danger" for="input-flete_p">
                        		{{ $errors->first('flete_p') }}
                      		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('flete_d') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="flete_d">{{ __('Flete D') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('flete_d') ? ' is-invalid' : '' }}" name="flete_d" id="input-flete_d" step="0.0001" min = "0" value="{{ old('flete_d', 0) }}" aria-required="true" aria-describedby="flete_dHelp" >
                    	@if ($errors->has('flete_d'))
                      		<span id="flete_d-error" class="error text-danger" for="input-flete_d">
                        		{{ $errors->first('flete_d') }}
                      		</span>
                    	@endif
                  	</div>
                </div>

                <div class="row mt-2">

                	<div class="form-group{{ $errors->has('ieps_r') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="ieps_r">{{ __('IEPS R') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('ieps_r') ? ' is-invalid' : '' }}" name="ieps_r" id="input-ieps_r" step="0.0001" min = "0" value="{{ old('ieps_r', 0) }}" aria-required="true" aria-describedby="ieps_rHelp">
                    	@if ($errors->has('ieps_r'))
                      		<span id="ieps_r-error" class="error text-danger" for="input-ieps_r">
                        		{{ $errors->first('ieps_r') }}
                      		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('ieps_p') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="ieps_p">{{ __('IEPS P') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('ieps_p') ? ' is-invalid' : '' }}" name="ieps_p" id="input-ieps_p" step="0.0001" min = "0" value="{{ old('ieps_p', 0) }}" aria-required="true" aria-describedby="ieps_dHelp">
                    	@if ($errors->has('ieps_p'))
                      		<span id="ieps_p-error" class="error text-danger" for="input-ieps_p">
                        		{{ $errors->first('ieps_p') }}
                      		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('ieps_d') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="ieps_d">{{ __('IEPS D') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('ieps_d') ? ' is-invalid' : '' }}" name="ieps_d" id="input-ieps_d" step="0.0001" min = "0" value="{{ old('ieps_d', 0) }}" aria-required="true" aria-describedby="ieps_dHelp">
                    	@if ($errors->has('ieps_d'))
                      		<span id="ieps_d-error" class="error text-danger" for="input-ieps_d">
                        		{{ $errors->first('ieps_d') }}
                      		</span>
                    	@endif
                  	</div>
                </div>

                <div class="row mt-2">

                	<div class="form-group{{ $errors->has('utilidad_r') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="utilidad_r">{{ __('Utilidad R') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('utilidad_r') ? ' is-invalid' : '' }}" name="utilidad_r" id="input-utilidad_r" step="0.0001" min = "0" value="{{ old('utilidad_r', 0) }}" aria-required="true" aria-describedby="utilidad_rHelp">
                    	@if ($errors->has('utilidad_r'))
                      		<span id="utilidad_r-error" class="error text-danger" for="input-utilidad_r">
                        		{{ $errors->first('utilidad_r') }}
                      		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('utilidad_p') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="utilidad_p">{{ __('Utilidad P') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('utilidad_p') ? ' is-invalid' : '' }}" name="utilidad_p" id="input-utilidad_p" step="0.0001" min = "0" value="{{ old('utilidad_p', 0) }}" aria-required="true" aria-describedby="utilidad_pHelp">
                    	@if ($errors->has('utilidad_p'))
                      		<span id="utilidad_p-error" class="error text-danger" for="input-utilidad_p">
                        		{{ $errors->first('utilidad_p') }}
                      		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('utilidad_d') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="utilidad_d">{{ __('Utilidad D') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('utilidad_d') ? ' is-invalid' : '' }}" name="utilidad_d" id="input-utilidad_d" step="0.0001" min = "0" value="{{ old('utilidad_d', 0) }}" aria-required="true" aria-describedby="utilidad_dHelp"  step="0.0001" >
                    	@if ($errors->has('utilidad_d'))
                      		<span id="utilidad_d-error" class="error text-danger" for="input-utilidad_d">
                        		{{ $errors->first('utilidad_d') }}
                      		</span>
                    	@endif
                  	</div>
                </div>

              <div class="row">

  				<div class="form-group col-sm-4 text-center">
  					<label for="credito">{{ __('Estatus Activa') }}</label>
  					<div class="togglebutton">
  						<label>
  							<input type="checkbox" name="status" checked="true">
  							<span class="toggle"></span>
  						</label>
  					</div>
              	</div>

  				<div class="form-group  col-sm-4 text-center">
  					<label for="credito">{{ __('Activar Credito') }}</label>
  					<div class="togglebutton">
  						<label>
  							<input type="checkbox" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" name="linea_credito" id="input-linea_credito">
  							<span class="toggle"></span>
  						</label>
  					</div>
              	</div>

              	<div class="form-group col-sm-4 text-center">
  					<label for="credito">{{ __('Datos Fiscales') }}</label>
  					<div class="togglebutton">
  						<label>
  							<input type="checkbox" data-toggle="collapse" href="#datosfiscales" aria-expanded="false" aria-controls="datosfiscales" name="datos_fiscales" id="input-datos_fiscales">
  							<span class="toggle"></span>
  						</label>
  					</div>
              	</div>
          	</div>

              <div class="collapse" id="collapseExample">

              	<div class="row mt-3">
              		
                  	<div class="form-group{{ $errors->has('credito') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="credito">{{ __('Credito') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('credito') ? ' is-invalid' : '' }}" name="credito" id="input-credito" value="{{ old('credito',0) }}" required="true" aria-required="true" aria-describedby="creditoHelp"  required="true" >
                    	@if ($errors->has('credito'))
                      		<span id="credito-error" class="error text-danger" for="input-credito">
                        		{{ $errors->first('credito') }}
                       		</span>
                   	 	@endif
                 	</div>

                 	<input type="hidden" class="form-control" name="credito_usado" id="input-credito_usado" value="0">

                 	<input type="hidden" class="form-control" name="saldo" id="input-saldo" value="0">
                 	

                  	<div class="form-group{{ $errors->has('dias_credito') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="dias_credito">{{ __('Dias credito') }}</label>
                    	<input type="number" class="form-control{{ $errors->has('dias_credito') ? ' is-invalid' : '' }}" id="input-dias_credito" aria-describedby="dias_creditoHelp" value="{{ old('dias_credito',10) }}" required="true" aria-required="true" name="dias_credito">
                    	@if ($errors->has('dias_credito'))
                      		<span id="dias_credito-error" class="error text-danger" for="input-dias_credito">
                        		{{ $errors->first('dias_credito') }}
                      		</span>
                    	@endif
                  	</div>



                  <div class="form-group{{ $errors->has('retencion') ? ' has-danger' : '' }} col-sm-4">
                    <label for="retencion">{{ __('Retencion') }}</label>
                    <input type="number" class="form-control{{ $errors->has('retencion') ? ' is-invalid' : '' }}" id="input-retencion" aria-describedby="retencionHelp" value="{{ old('retencion',0) }}" required="true" aria-required="true" name="retencion">
                    @if ($errors->has('retencion'))
                      <span id="retencion-error" class="error text-danger" for="input-retencion">
                        {{ $errors->first('retencion') }}
                      </span>
                    @endif
                  </div>

                </div>
              </div>


              <div class="collapse" id="datosfiscales">
              	<div class="row mt-5">

              		<div class="form-group{{ $errors->has('codigo_postal') ? ' has-danger' : '' }} col-sm-3">
                    	<label for="codigo_postal">{{ __('Codigo Postal') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('codigo_postal') ? ' is-invalid' : '' }}" name="codigo_postal" id="input-codigo_postal" value="{{ old('codigo_postal') }}"aria-required="true" aria-describedby="codigo_postalHelp">
                    	@if ($errors->has('codigo_postal'))
                      		<span id="codigo_postal-error" class="error text-danger" for="input-codigo_postal">
                        		{{ $errors->first('codigo_postal') }}
                       		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('tipo_de_vialidad') ? ' has-danger' : '' }} col-sm-3">
                    	<label for="tipo_de_vialidad">{{ __('Tipo de vialidad') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('tipo_de_vialidad') ? ' is-invalid' : '' }}" name="tipo_de_vialidad" id="input-tipo_de_vialidad" value="{{ old('tipo_de_vialidad') }}"aria-required="true" aria-describedby="tipo_de_vialidadHelp" >
                    	@if ($errors->has('tipo_de_vialidad'))
                      		<span id="tipo_de_vialidad-error" class="error text-danger" for="input-tipo_de_vialidad">
                        		{{ $errors->first('tipo_de_vialidad') }}
                       		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('nombre_de_vialidad') ? ' has-danger' : '' }} col-sm-3">
                    	<label for="nombre_de_vialidad">{{ __('Nombre de la Vialidad') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('nombre_de_vialidad') ? ' is-invalid' : '' }}" name="nombre_de_vialidad" id="input-nombre_de_vialidad" value="{{ old('nombre_de_vialidad') }}"aria-required="true" aria-describedby="nombre_de_vialidadlHelp" >
                    	@if ($errors->has('nombre_de_vialidad'))
                      		<span id="nombre_de_vialidad-error" class="error text-danger" for="input-nombre_de_vialidad">
                        		{{ $errors->first('nombre_de_vialidad') }}
                       		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('n_exterior') ? ' has-danger' : '' }} col-sm-3">
                    	<label for="n_exterior">{{ __('n° exterior') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('n_exterior') ? ' is-invalid' : '' }}" name="n_exterior" id="input-n_exterior" value="{{ old('n_exterior') }}"aria-required="true" aria-describedby="n_exteriorHelp">
                    	@if ($errors->has('n_exterior'))
                      		<span id="n_exterior-error" class="error text-danger" for="input-n_exterior">
                        		{{ $errors->first('n_exterior') }}
                       		</span>
                    	@endif
                  	</div>
              		
              	</div>

              	<div class="row">

              		<div class="form-group{{ $errors->has('n_interior') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="n_interior">{{ __('n° interior') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('n_interior') ? ' is-invalid' : '' }}" name="n_interior" id="input-n_interior" value="{{ old('n_interior') }}"aria-required="true" aria-describedby="n_interiorlHelp">
                    	@if ($errors->has('n_interior'))
                      		<span id="n_interior-error" class="error text-danger" for="input-n_interior">
                        		{{ $errors->first('n_interior') }}
                       		</span>
                    	@endif
                  	</div>
              		
              		<div class="form-group{{ $errors->has('nombre_colonia') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="nombre_colonia">{{ __('Nombre de la Colonia') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('nombre_colonia') ? ' is-invalid' : '' }}" name="nombre_colonia" id="input-nombre_colonia" value="{{ old('nombre_colonia') }}"aria-required="true" aria-describedby="nombre_colonialHelp">
                    	@if ($errors->has('nombre_colonia'))
                      		<span id="nombre_colonia-error" class="error text-danger" for="input-nombre_colonia">
                        		{{ $errors->first('nombre_colonia') }}
                       		</span>
                    	@endif
                  	</div>

                  	<div class="form-group{{ $errors->has('nombre_localidad') ? ' has-danger' : '' }} col-sm-4">
                    	<label for="nombre_localidad">{{ __('Nombre de la Localidad') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('nombre_localidad') ? ' is-invalid' : '' }}" name="nombre_localidad" id="input-nombre_localidad" value="{{ old('nombre_localidad') }}" aria-required="true" aria-describedby="nombre_localidadlHelp" >
                    	@if ($errors->has('nombre_localidad'))
                      		<span id="nombre_localidad-error" class="error text-danger" for="input-nombre_localidad">
                        		{{ $errors->first('nombre_localidad') }}
                       		</span>
                    	@endif
                  	</div>

              		
              	</div>

              	<div class="row">

                  <div class="form-group{{ $errors->has('nombre_municipio_o_demarcacion_territorial') ? ' has-danger' : '' }} col-sm-6">
                      <label for="nombre_municipio_o_demarcacion_territorial">{{ __('Nombre del Municipio o Demarcacion Territorial') }}</label>
                      <input type="text" class="form-control{{ $errors->has('nombre_municipio_o_demarcacion_territorial') ? ' is-invalid' : '' }}" name="nombre_municipio_o_demarcacion_territorial" id="input-nombre_municipio_o_demarcacion_territorial" value="{{ old('nombre_municipio_o_demarcacion_territorial') }}"aria-required="true" aria-describedby="nombre_municipio_o_demarcacion_territorialHelp">
                      @if ($errors->has('nombre_municipio_o_demarcacion_territorial'))
                          <span id="nombre_municipio_o_demarcacion_territorial-error" class="error text-danger" for="input-nombre_municipio_o_demarcacion_territorial">
                            {{ $errors->first('nombre_municipio_o_demarcacion_territorial') }}
                          </span>
                      @endif
                  </div>

              		<div class="form-group{{ $errors->has('nombre_entidad_federativa') ? ' has-danger' : '' }} col-sm-6">
                    	<label for="nombre_entidad_federativa">{{ __('Nombre de la entidad federativa') }}</label>
                    	<input type="text" class="form-control{{ $errors->has('nombre_entidad_federativa') ? ' is-invalid' : '' }}" name="nombre_entidad_federativa" id="input-nombre_entidad_federativa" value="{{ old('nombre_entidad_federativa') }}"aria-required="true" aria-describedby="nombre_entidad_federativarlHelp">
                    	@if ($errors->has('nombre_entidad_federativa'))
                      		<span id="nombre_entidad_federativa-error" class="error text-danger" for="input-nombre_entidad_federativa">
                        		{{ $errors->first('nombre_entidad_federativa') }}
                       		</span>
                    	@endif
                  	</div>

              	</div>

                <div class="row">
                  <div class="form-group{{ $errors->has('entre_calle') ? ' has-danger' : '' }} col-sm-6">
                    <label for="entre_calle">{{ __('Entre Calle') }}</label>
                    <input type="text" class="form-control{{ $errors->has('entre_calle') ? ' is-invalid' : '' }}" name="entre_calle" id="input-entre_calle" value="{{ old('entre_calle') }}"aria-required="true" aria-describedby="entre_calleHelp">
                    @if ($errors->has('entre_calle'))
                        <span id="entre_calle-error" class="error text-danger" for="input-entre_calle">
                          {{ $errors->first('entre_calle') }}
                        </span>
                    @endif
                  </div>

                  <div class="form-group{{ $errors->has('y_calle') ? ' has-danger' : '' }} col-sm-6">
                    <label for="y_calle">{{ __('y calle') }}</label>
                    <input type="text" class="form-control{{ $errors->has('y_calle') ? ' is-invalid' : '' }}" name="y_calle" id="input-y_calle" value="{{ old('y_calle') }}"aria-required="true" aria-describedby="y_calle">
                    @if ($errors->has('y_calle'))
                        <span id="y_calle-error" class="error text-danger" for="input-y_calle">
                          {{ $errors->first('y_calle') }}
                        </span>
                    @endif
                  </div>
                </div>

              </div>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
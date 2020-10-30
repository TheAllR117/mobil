@extends('layouts.app', ['page' => __('Gestión de los abonos'), 'pageSlug' => __('Abonos')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 mx-auto d-block mt-3">
        <form action="{{ route('abonos.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
          @csrf
          @method('post')
          <div class="card bg-blue">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-white">
                <a href="{{ route('abonos.index') }}" title="Regresar a la lista">
                  <i class="tim-icons icon-minimal-left text-white"></i>
                </a>
                {{ __('Solicitar Abono') }}
              </h4>
            </div>
          </div>
          <div class="card ">
            <div class="card-body">

              <div class="container">
                <div class="row">
                  <div class="col-sm-6">

                    <div class="form-group{{ $errors->has('id_estacion') ? ' has-danger' : '' }} mt-5">
                      <label class="label-control" for="id_estacion">Estación</label><br>
                      <select class="selectpicker" data-style="btn btn-primary" data-live-search="true" data-width="100%" id="input-id_estacion" name="id_estacion">
                        <option disabled selected>-- Seleccionar --</option>
                        @foreach($estaciones as $estacion)
                          @if($estacion->nombre_sucursal != '*')
                          <option value="{{ $estacion->id }}">{{ $estacion->nombre_sucursal }}</option>
                          @endif
                        @endforeach
                      </select><br>
                      @if ($errors->has('id_estacion'))
                        <span class="error text-danger" for="input-id_estacion" id="id_estacion-error">
                          {{ $errors->first('id_estacion') }}
                        </span>
                      @endif
                    </div>

                    <div class="form-group{{ $errors->has('cantidad') ? ' has-danger' : '' }} mt-5">
                      <label for="cantidad" class="mt-2">{{ __('Cantidad') }}</label>
                      <input aria-describedby="cantidadHelp" aria-required="true" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }} mt-4"  id="input-cantidad" name="cantidad"  type="number" min="0.00" step="0.01" value="{{ old('cantidad', 0)}}">
                        @if ($errors->has('cantidad'))
                        <span class="error text-danger" for="input-cantidad" id="cantidad-error">
                          {{ $errors->first('cantidad') }}
                        </span>
                        @endif
                      </input>
                    </div>

                    <input type="hidden" name="id_status" value="1">
                    
                  </div>

                  <div class="col-sm-6">
                    <div class="fileinput fileinput-new text-center col align-self-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail img-raised">
                          <img src="https://camo.githubusercontent.com/f8ea5eab7494f955e90f60abc1d13f2ce2c2e540/68747470733a2f2f662e636c6f75642e6769746875622e636f6d2f6173736574732f323037383234352f3235393331332f35653833313336322d386362612d313165322d383435332d6536626439353663383961342e706e67" rel="nofollow" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                      <div>
                          <span class="btn btn-raised btn-round btn-default btn-file">
                              <span class="fileinput-new">Selecciona una imagen</span>
                              <span class="fileinput-exists">Cambiar</span>
                              <input type="file" name="url" id="input-url" accept='image/*'  value="{{ old('url')}}" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remover</a>
                      </div>
                      <br>
                      @if ($errors->has('url'))
                        <span class="error text-danger" for="input-input-url" id="input-url-error">
                          {{ $errors->first('url') }}
                        </span>
                      @endif
                    </div>
                  </div>
 
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
    iniciar_selector_de_archivos();
  });
</script>
@endpush

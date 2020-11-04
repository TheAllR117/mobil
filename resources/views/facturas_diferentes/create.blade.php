@extends('layouts.app', ['page' => __('Registrar facturas'), 'pageSlug' => __('Facturas diversas')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto d-block mt-3">
                <form action="{{ route('facturas_diferentes.store') }}" autocomplete="off" enctype="multipart/form-data" class="form-horizontal" method="post">
                  @csrf
                  @method('post')
                    <div class="card bg-blue">
                      <div class="card-header card-header-primary">
                          <h4 class="card-title text-white">
                              <a href="{{ route('facturas.index') }}" title="Regresar a la lista">
                                  <i class="tim-icons icon-minimal-left text-white"></i>
                              </a>
                              {{ __('Agregar Factura') }}
                          </h4>
                          <p class="card-category text-white">
                          </p>
                      </div>
                    </div>
                    <div class="card ">
                        <div class="card-body">     
                          <div class="row mt-3">
                              <div class="col-sm-6">
                                <label for="id_estacion">{{ __('Estación') }}</label>
                                <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" id="input-id_estacion" name="id_estacion" data-width="100%">
                                  <option disabled selected>Seleccionar</option>
                                  @foreach($estaciones as $estacion)
                                    @if($estacion->id != 1)
                                    <option value="{{$estacion->id}}">{{$estacion->nombre_sucursal}}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }} col-sm-6">
                                <label for="quantity">{{ __('Cantidad') }}</label>
                                <input aria-describedby="quantityHelp" aria-required="true" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" id="input-quantity" name="quantity"  type="number" min="0" value="{{ old('quantity',1)}}">
                                  @if ($errors->has('quantity'))
                                    <span class="error text-danger" for="input-quantity" id="quantity-error">
                                      {{ $errors->first('quantity') }}
                                    </span>
                                  @endif
                                </input>
                              </div>
                          </div>
                          <div class="row mt-3">

                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }} col-sm-12">
                              <label for="description">{{ __('Descripción') }}</label>
                              <input aria-describedby="descriptionHelp" aria-required="true" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="input-description" name="description" placeholder="Escribe una breve descripción" type="text" value="{{ old('description')}}">
                                @if ($errors->has('description'))
                                <span class="error text-danger" for="input-description" id="description-error">
                                {{ $errors->first('description') }}
                                </span>
                                @endif
                              </input>
                            </div>

                          </div>
                          <div class="row mb-3 mt-3">

                            <div class="form-group{{ $errors->has('file_pdf') ? ' has-danger' : '' }} col-sm-6">
                          
                              <label for="file_pdf">{{ __('PDF') }}</label><br>
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-outline-secondary btn-file">
                                  <span class="fileinput-new">Seleccionar PDF</span>
                                  <span class="fileinput-exists">Cambiar</span>
                                  <input type="file" name="file_pdf" accept="application/pdf" multiple>
                                    @if ($errors->has('file_pdf'))
                                      <span class="error text-danger" for="input-file_pdf" id="file_pdf-error">
                                        {{ $errors->first('file_pdf') }}
                                      </span>
                                    @endif
                                  </input>
                                </span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                              </div>

                            </div>

                            <div class="form-group{{ $errors->has('file_xml') ? ' has-danger' : '' }} col-sm-6">
                          
                              <label for="file_xml">{{ __('XML') }}</label><br>
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-outline-primary btn-file">
                                  <span class="fileinput-new">Seleccionar XML</span>
                                  <span class="fileinput-exists">Cambiar</span>
                                  <input type="file" name="file_xml" accept="text/xml" multiple>
                                    @if ($errors->has('file_xml'))
                                      <span class="error text-danger" for="input-file_xml" id="file_xml-error">
                                        {{ $errors->first('file_xml') }}
                                      </span>
                                    @endif
                                  </input>
                                </span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                              </div>

                            </div>

                            
                          </div>

                          <div class="row mt-6 mb-6">

                            <div class="form-group{{ $errors->has('add_or_subtract') ? ' has-danger' : '' }} col-sm-6">
                              <div class="form-group">
                                <label>{{ __('Emición de Factura') }}</label>
                                <input type="text" class="form-control datetimepicker bg-white mt-1" id="fecha_deposito" name="expiration_date" />
                              </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('add_or_subtract') ? ' has-danger' : '' }} col-sm-6">
                              <label for="add_or_subtract">{{ __('Pagos') }}</label><br>
                              <input type="checkbox" checked name="add_or_subtract" class="bootstrap-switch form-control{{ $errors->has('add_or_subtract') ? ' is-invalid' : '' }}"
                                  data-on-label="Si"
                                  data-off-label="No"
                              />
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
  const timeElapsed = Date.now();
  const today = new Date(timeElapsed);
  $(document).ready(function() {
      init_calendar_2('fecha_deposito','01-01-2020', today.toISOString());
    });
</script>
@endpush

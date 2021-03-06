@extends('layouts.app', ['page' => __('Gestión de Fleteras'), 'pageSlug' => __('Fleteras')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto d-block mt-3">
                <form action="{{ route('tractores.store') }}" autocomplete="off" class="form-horizontal" method="post">
                  @csrf
                  @method('post')
                    <div class="card bg-blue">
                      <div class="card-header card-header-primary">
                        <h4 class="card-title text-white">
                          <a href="{{ route('tractores.index') }}" title="Regresar a la lista">
                            <i class="tim-icons icon-minimal-left text-white"></i>
                          </a>
                          {{ __('Agregar Tractor') }}
                        </h4>
                      </div>
                    </div>
                    <div class="card ">
                        <div class="card-body">
                            <div class="row">

                              <div class="form-group{{ $errors->has('tractor') ? ' has-danger' : '' }} col-sm-4">
                                <label for="tractor">{{ __('Tractor') }}</label>
                                <input aria-describedby="tractorHelp" aria-required="true" class="form-control{{ $errors->has('tractor') ? ' is-invalid' : '' }}" id="input-tractor" name="tractor" placeholder="Escribe un nombre" type="text" value="{{ old('tractor')}}">
                                  @if ($errors->has('tractor'))
                                    <span class="error text-danger" for="input-tractor" id="tractor-error">
                                      {{ $errors->first('tractor') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="form-group{{ $errors->has('placas') ? ' has-danger' : '' }} col-sm-4">
                                <label for="placas">{{ __('Placas') }}</label>
                                <input aria-describedby="placasHelp" aria-required="true" class="form-control{{ $errors->has('placas') ? ' is-invalid' : '' }}" id="input-placas" name="placas" placeholder="Escribe la placa" type="text" value="{{ old('placas')}}">
                                  @if ($errors->has('placas'))
                                    <span class="error text-danger" for="input-placas" id="placas-error">
                                      {{ $errors->first('placas') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="form-group{{ $errors->has('marca') ? ' has-danger' : '' }} col-sm-4">
                                <label for="marca">{{ __('Marca') }}</label>
                                <input aria-describedby="marcaHelp" aria-required="true" class="form-control{{ $errors->has('marca') ? ' is-invalid' : '' }}" id="input-capacidad" name="marca"  type="text" value="{{ old('marca')}}">
                                  @if ($errors->has('marca'))
                                    <span class="error text-danger" for="input-marca" id="marca-error">
                                      {{ $errors->first('marca') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                            </div>
                            <div class="row">

                              <div class="form-group{{ $errors->has('modelo') ? ' has-danger' : '' }} col-sm-4">
                                <label for="modelo">{{ __('Modelo') }}</label>
                                <input aria-describedby="modeloHelp" aria-required="true" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" id="input-modelo" name="modelo" type="text" value="{{ old('modelo')}}">
                                  @if ($errors->has('modelo'))
                                    <span class="error text-danger" for="input-modelo" id="modelo-error">
                                      {{ $errors->first('modelo') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }} col-sm-4">
                                <label for="descripcion">{{ __('Descripcion') }}</label>
                                <input aria-describedby="descripcionHelp" aria-required="true" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="input-descripcion" name="descripcion" type="text" value="{{ old('descripcion')}}">
                                  @if ($errors->has('descripcion'))
                                    <span class="error text-danger" for="input-descripcion" id="descripcion-error">
                                      {{ $errors->first('descripcion') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="col-sm-4">
                                <select class="selectpicker mt-4" data-style="btn btn-primary" title="Single Select" id="input-id_status" name="id_status">
                                  <option disabled selected>Estatus</option>
                                  @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->estado }}</option>
                                  @endforeach
                                </select>
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

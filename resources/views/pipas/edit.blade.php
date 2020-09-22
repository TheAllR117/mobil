@extends('layouts.app', ['activePage' => 'Fleteras', 'titlePage' => __('Gestión de las pipas')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto d-block mt-3">
                <form action="{{ route('pipas.update', $pipe_edit) }}" autocomplete="off" class="form-horizontal" method="post">
                    @csrf
                    @method('post')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">
                                {{ __('Editar Pipa') }}
                            </h4>
                            <p class="card-category">
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                              <div class="col-12 text-left">
                                <a href="{{ route('pipas.index') }}" class="btn btn-social btn-just-icon btn-primary" title="Regresar a la lista">
                                    <i class="material-icons">arrow_back_ios</i>
                                </a>
                              </div>
                            </div>
                            
                            
                            <div class="row">

                              <div class="form-group{{ $errors->has('numero') ? ' has-danger' : '' }} col-sm-4">
                                <label for="numero">{{ __('Numero de Série') }}</label>
                                <input aria-describedby="numeroHelp" aria-required="true" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" id="input-numero" name="numero" placeholder="Escribe un Número" type="text" value="{{ old('numero',$pipe_edit->numero)}}">
                                  @if ($errors->has('numero'))
                                    <span class="error text-danger" for="input-numero" id="numero-error">
                                      {{ $errors->first('numero') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="form-group{{ $errors->has('numero_economico') ? ' has-danger' : '' }} col-sm-4">
                                <label for="numero_economico">{{ __('Número Economico') }}</label>
                                <input aria-describedby="numero_economicoHelp" aria-required="true" class="form-control{{ $errors->has('numero_economico') ? ' is-invalid' : '' }}" id="input-numero_economico" name="numero_economico" placeholder="Escribe un el Número Economico" type="text" value="{{ old('numero_economico',$pipe_edit->numero_economico)}}">
                                  @if ($errors->has('numero_economico'))
                                    <span class="error text-danger" for="input-numero_economico" id="numero_economico-error">
                                      {{ $errors->first('numero_economico') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="form-group{{ $errors->has('capacidad') ? ' has-danger' : '' }} col-sm-4">
                                <label for="capacidad">{{ __('Capacidad (LTS)') }}</label>
                                <input aria-describedby="capacidadHelp" aria-required="true" class="form-control{{ $errors->has('capacidad') ? ' is-invalid' : '' }}" id="input-capacidad" name="capacidad"  type="number" value="{{ old('capacidad',$pipe_edit->capacidad)}}">
                                  @if ($errors->has('capacidad'))
                                    <span class="error text-danger" for="input-capacidad" id="capacidad-error">
                                      {{ $errors->first('capacidad') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                            </div>
                            <div class="row">

                              <div class="form-group{{ $errors->has('compartimentos') ? ' has-danger' : '' }} col-sm-4">
                                <label for="compartimentos">{{ __('Compartimentos') }}</label>
                                <input aria-describedby="compartimentosHelp" aria-required="true" class="form-control{{ $errors->has('compartimentos') ? ' is-invalid' : '' }}" id="input-compartimentos" name="compartimentos" type="number" value="{{ old('compartimentos',$pipe_edit->compartimentos)}}">
                                  @if ($errors->has('compartimentos'))
                                    <span class="error text-danger" for="input-compartimentos" id="compartimentos-error">
                                      {{ $errors->first('compartimentos') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="form-group{{ $errors->has('capacidad_compartimiento') ? ' has-danger' : '' }} col-sm-4">
                                <label for="capacidad_compartimiento">{{ __('Capacidad por Compartimiento (LTS)') }}</label>
                                <input aria-describedby="capacidad_compartimientoHelp" aria-required="true" class="form-control{{ $errors->has('capacidad_compartimiento') ? ' is-invalid' : '' }}" id="input-capacidad_compartimiento" name="capacidad_compartimiento" type="number" value="{{ old('capacidad_compartimiento',$pipe_edit->capacidad_compartimiento)}}">
                                  @if ($errors->has('capacidad_compartimiento'))
                                    <span class="error text-danger" for="input-capacidad_compartimiento" id="capacidad_compartimiento-error">
                                      {{ $errors->first('capacidad_compartimiento') }}
                                    </span>
                                  @endif
                                </input>
                              </div>

                              <div class="col-sm-4">
                                <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-id_status" name="id_status" data-width="100%">
                                  <option disabled>Estatus</option>
                                  @foreach($states as $state)
                                    @if($pipe_edit->id_status == $state->id)
                                        <option value="{{ $state->id }}" selected>{{ $state->estado }}</option>
                                    @else
                                        <option value="{{ $state->id }}">{{ $state->estado }}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-sm-4">
                                <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-tractor_id" name="tractor_id" data-width="100%">
                                  <option disabled selected>Tractores</option>
                                  @foreach($tractors as $tractor)
                                    @if (count($tractor->pipes)<3)
                                      <option value="{{ $tractor->id }}">{{ $tractor->tractor }}</option>  
                                    @else
                                      <option value="{{ $tractor->id }}" disabled>{{ $tractor->tractor }} - Relacionado {{count($tractor->pipes)}} veces</option>  
                                    @endif
                                  @endforeach
                                </select>
                              </div>

                              <input type="hidden" name="contenedor_disponible" value="{{ $pipe_edit->contenedor_disponible }}">

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

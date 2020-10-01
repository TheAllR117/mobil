@extends('layouts.app', ['page' => __('Alta de Terminales'), 'pageSlug' => __('Terminales')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto d-block mt-3">
                <form action="{{ route('terminales.update', $terminal) }}" autocomplete="off" class="form-horizontal" method="post">
                    @csrf
            		@method('post')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">
                                <a href="{{ route('terminales.index') }}" title="Regresar a la lista">
                                    <i class="tim-icons icon-minimal-left text-danger"></i>
                                </a>
                                {{ __('Editar Terminal') }}
                            </h4>
                            <p class="card-category">
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group{{ $errors->has('razon_social') ? ' has-danger' : '' }} col-sm-12">
                                    <label for="razon_social">{{ __('Nombre de la terminal') }}</label>
                                    <input type="text" class="form-control{{ $errors->has('razon_social') ? ' is-invalid' : '' }}" id="input-razon_social" aria-describedby="razon_socialHelp"value="{{ old('razon_social',$terminal->razon_social)}}" aria-required="true" name="razon_social">
                                    @if ($errors->has('razon_social'))
                                      <span id="razon_social-error" class="error text-danger" for="input-razon_social">
                                        {{ $errors->first('razon_social') }}
                                      </span>
                                    @endif
                                </div>

                                
                            </div>

                            <div class="row">
                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }} col-md-12">
                                    <label for="input-rol">
                                        Estado
                                    </label>
                                    <div class="form-group">
                                      <select class="selectpicker form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" id="input-rol" name="status">
                                         @if($terminal->status == 1)
                                            <option selected="" value="{{ $terminal->status }}">
                                                Activo
                                            </option>
                                            <option value="0">
                                                Inactivo
                                            </option>
                                            @else
                                            <option value="1">
                                                Activo
                                            </option>
                                            <option selected="" value="{{ $terminal->status }}">
                                                Inactivo
                                            </option>
                                            @endif
                                      </select>
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

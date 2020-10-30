@extends('layouts.app', ['page' => __('Alta de Terminales'), 'pageSlug' => __('Terminales')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto d-block mt-3">
                <div class="card bg-blue">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-white">
                            <a href="{{ route('terminales.index') }}" title="Regresar a la lista">
                                <i class="tim-icons icon-minimal-left text-white"></i>
                            </a>
                            {{ __('Terminales') }}
                        </h4>
                        <p class="card-category text-white mb-3">
                            {{ __('Aquí puedes agregar una terminal.') }}
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                            
                        <form action="{{ route('terminales.store') }}" autocomplete="off" class="form-horizontal mt-3" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                
                                <div class="form-group{{ $errors->has('razon_social') ? ' has-danger' : '' }} col-sm-6">
                                    <label for="razon_social">{{ __('Nombre de la terminal') }}</label>
                                    <input type="text" class="form-control{{ $errors->has('razon_social') ? ' is-invalid' : '' }}" id="input-razon_social" aria-describedby="razon_socialHelp"  value="{{ old('razon_social')}}" aria-required="true" name="razon_social">
                                    @if ($errors->has('razon_social'))
                                        <span id="razon_social-error" class="error text-danger" for="input-razon_social">
                                        {{ $errors->first('razon_social') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('codigo') ? ' has-danger' : '' }} col-sm-6">
                                    <label for="codigo">{{ __('Clave') }}</label>
                                    <input type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" id="input-codigo" aria-describedby="codigoHelp"  value="{{ old('codigo')}}" aria-required="true" name="codigo">
                                    @if ($errors->has('codigo'))
                                        <span id="codigo-error" class="error text-danger" for="input-codigo">
                                        {{ $errors->first('codigo') }}
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <input type="hidden" name="status" value="1">
                            <div class="card-footer ml-auto mr-auto mt-3">
                                <button type="submit" class="btn btn-primary">{{ __('Añadir Terminal') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

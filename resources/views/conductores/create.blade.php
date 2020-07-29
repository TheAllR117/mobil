@extends('layouts.app', ['activePage' => 'Fleteras', 'titlePage' => __('Gestión de las pipas')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 mx-auto d-block mt-3">
        <form action="{{ route('conductores.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
          @csrf
          @method('post')
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">
                  {{ __('Agregar Conductor') }}
              </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body">

            	<div class="row">
                <div class="col-12 text-left">
                  <a href="{{ route('conductores.index') }}" class="btn btn-social btn-just-icon btn-primary" title="Regresar a la lista">
                      <i class="material-icons">arrow_back_ios</i>
                  </a>
                </div>
	            </div>
              <div class="row">
                <div class="col-sm-6">
                 <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} ">
                    <label for="name" class="">{{ __('Nombre del conductor') }}</label>
                    <input aria-describedby="nameHelp" aria-required="true" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} mt-4"  id="input-name" name="name"  type="text" value="{{ old('name')}}">
                      @if ($errors->has('name'))
                      <span class="error text-danger" for="input-name" id="name-error">
                        {{ $errors->first('name') }}
                      </span>
                      @endif
                    </input>
                  </div> 
                </div>

                <div class="col-sm-6 mt-3">
                  <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-id_status" name="id_status" data-width="100%">
                    <option disabled selected>Estatus</option>
                    @foreach($states as $state)
                      @if($state->id < 2)
                      <option value="{{ $state->id }}">{{ $state->estado }}</option>
                      @endif
                    @endforeach
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

@push('js')
<script>
    $(document).ready(function(){
    iniciar_selector_de_archivos();
  });
</script>
@endpush

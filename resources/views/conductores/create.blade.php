@extends('layouts.app', ['page' => __('Gestión de Fleteras'), 'pageSlug' => __('Fleteras')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto d-block mt-3">
        <form action="{{ route('conductores.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
          @csrf
          @method('post')
          <div class="card bg-blue">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-white">
                <a href="{{ route('conductores.index') }}" title="Regresar a la lista">
                  <i class="tim-icons icon-minimal-left text-white"></i>
                </a>
                {{ __('Agregar Conductor') }}
              </h4>
            </div>
          </div>
          <div class="card ">
            <div class="card-body">

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

                <div class="col-sm-6">
                  <label for="name" >{{ __('Estatus') }}</label>
                  <select class="selectpicker mt-4" data-style="btn btn-primary" title="Single Select" id="input-id_status" name="id_status" data-width="100%">
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

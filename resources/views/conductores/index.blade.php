@extends('layouts.app', ['page' => __('Gestión de Fleteras'), 'pageSlug' => __('Fleteras')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">
                  <a href="{{ route('fleteras.index') }}" title="Regresar a la lista">
                    <i class="tim-icons icon-minimal-left text-danger"></i>
                  </a>
                  {{ __('Conductores') }}
                </h4>
                <p class="card-category"> {{ __('Aquí puedes administrar a todos los conductores.') }}</p>
              </div>
              <div class="card-body">

                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row justify-content-end">
                  <div class="col-2 text-right">
                     <a href="{{ route('conductores.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar Conductor') }}</a>
                  </div>
                </div>

                <div class="row">

                  <div class="table-responsive">
                    <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                      <thead class=" text-primary">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Nombre del Conductor') }}</th>
                        <th>{{ __('Fecha de registro') }}</th>

                        @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                        <th class="text-center th-actions">{{ __('Acciones') }}</th>

                        @endif
                      </thead>
                      <tbody>
                        @foreach($drivers as $driver)
                          <tr>
                            <td>{{ $driver->id }}</td>
                            <td>{{ $driver->name}}</td>
                            <td>{{ $driver->created_at->format('d/m/Y') }}</td>

                            @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                            <td class="td-actions justify-content-center">
                              <form action="{{ route('conductores.destroy', $driver->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <a class="btn btn-success btn-link" data-original-title="" href="{{ route('conductores.edit',$driver) }}" rel="tooltip" title="">
                                  <i class="tim-icons icon-pencil"></i>
                                </a>
                             
                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar Abono" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta pipa?") }}') ? this.parentElement.submit() : ''">
                                  <i class="tim-icons icon-trash-simple"></i>
                                </button>
                              </form>
                            </td>
                            @endif
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                  

                    </div>
                  </div>
                </div>

                

              	</div>
          	</div>
        </div>
      </div>
	</div>
  </div>
@endsection

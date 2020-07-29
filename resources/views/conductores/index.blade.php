@extends('layouts.app', ['activePage' => 'Fleteras', 'titlePage' => __('Gestión de las pipas')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Conductores') }}</h4>
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
                <div class="row">
                  <div class="col-10 text-left">
                    <a href="{{ route('fleteras.index') }}" class="btn btn-social btn-just-icon btn-primary" title="Regresar a la lista">
                        <i class="material-icons">arrow_back_ios</i>
                    </a>
                  </div>
                  <div class="col-2 text-right">
                     <a href="{{ route('conductores.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar Conductor') }}</a>
                  </div>
                </div>

                <div class="row">

                  <div class="table-responsive">
                    <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables">
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
                            <td class="td-actions">
                              <form action="{{ route('conductores.destroy', $driver->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <a class="btn btn-success btn-link" data-original-title="" href="{{ route('conductores.edit',$driver) }}" rel="tooltip" title="">
                                    <i class="material-icons">
                                        edit
                                    </i>
                                    <div class="ripple-container">
                                    </div>
                                </a>
                             
                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar Abono" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta pipa?") }}') ? this.parentElement.submit() : ''">
                                  <i class="material-icons">delete_forever</i>
                                  <div class="ripple-container"></div>
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

@push('js')
  <script>
   $(document).ready(function() {
    	iniciar_date('datatables');
    });
  </script>
@endpush
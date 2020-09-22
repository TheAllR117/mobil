@extends('layouts.app', ['activePage' => 'Fleteras', 'titlePage' => __('Gestión de Fleteras')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Relación de Fleteras') }}</h4>
                <p class="card-category"> {{ __('Aquí puedes administrar todas las relaciones de las fleteras.') }}</p>
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
                	<div class="col-4 text-right">
                		<a href="{{ route('registro_fleteras.index') }}" class="btn btn-sm btn-primary">{{ __('gestionar fleteras') }}
                		</a>
	                </div>
                	<div class="col-2 text-right">
                		<a href="{{ route('pipas.index') }}" class="btn btn-sm btn-primary">{{ __('gestionar pipas') }}</a>
	                </div>
	                <div class="col-2 text-right">
                		<a href="{{ route('tractores.index') }}" class="btn btn-sm btn-primary">{{ __('gestionar tractores') }}</a>
	                </div>
	                <div class="col-2 text-right">
                		<a href="{{ route('conductores.index') }}" class="btn btn-sm btn-primary">{{ __('gestionar conductores') }}</a>
	                </div>
	                <div class="col-2 text-right">
	                  <a href="{{ route('fleteras.create') }}" class="btn btn-sm btn-primary">
                      {{ __('Relacionar Fletera') }}
                    </a>
	                </div>
                </div>
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables">
                    <thead class=" text-primary">
                      <th>
                        {{ __('Fletera') }}
                      </th>
                      <th>
                        {{ __('Tractor') }}
                      </th>
                      <th>
                        {{ __('Pipa 1') }}
                      </th>
                      <th>
                        {{ __('Pipa 2') }}
                      </th>
                      <th>
                        {{ __('Pipa 3') }}
                      </th>
                      <th>
                        {{ __('Fecha de Alta') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($freights as $freight)
                        @if($freight->id_estacion ==  "")
                        <tr>
                          <td>
                            {{ $freight->namefreights[0]->name }}
                          </td>
                          <td>
                            {{ $freight->tractors[0]->tractor }}
                          </td>
                          @foreach ($freight->tractors as $tractor)
                            @for ($i = 0; $i < 3; $i++)
                                @if (isset($tractor->pipes[$i]))
                                <td>
                                  {{$tractor->pipes[$i]->numero_economico}}
                                </td>    
                                @else
                                <td>
                                  No hay pipa
                                </td>            
                                @endif
                            @endfor
                          @endforeach
                          <td>
                            {{ $freight->created_at->format('d/m/Y') }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('fleteras.destroy', $freight->id) }}" method="post">
                              @csrf
                              @method('delete')
                              <a class="btn btn-success btn-link" data-original-title=""
                                href="{{ route('fleteras.edit', $freight) }}" rel="tooltip"
                                title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container">
                                </div>
                              </a>
                              <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar esta relación.?") }}') ? this.parentElement.submit() : ''">
                                <i class="material-icons">close</i>
                                <div class="ripple-container"></div>
                              </button>
                            </form>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Relación de Estación') }}</h4>
              </div>
              <div class="card-body">
               
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables1">
                    <thead class=" text-primary">
                      <th>
                        {{ __('Estación') }}
                      </th>
                      <th>
                        {{ __('Tractor') }}
                      </th>
                      <th>
                        {{ __('Pipa 1') }}
                      </th>
                      <th>
                        {{ __('Pipa 2') }}
                      </th>
                      <th>
                        {{ __('Pipa 3') }}
                      </th>
                      <th>
                        {{ __('Fecha de Alta') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($freights as $freight)
                        @if($freight->id_freights == "")
                        <tr>
                          <td>
                            {{ $freight->estacions[0]->nombre_sucursal }}
                          </td>
                          <td>
                            {{ $freight->tractors[0]->tractor }}
                          </td>
                          @foreach ($freight->tractors as $tractor)
                            @for ($i = 0; $i < 3; $i++)
                                @if (isset($tractor->pipes[$i]))
                                <td>
                                  {{$tractor->pipes[$i]->numero_economico}}
                                </td>    
                                @else
                                <td>
                                  No hay pipa
                                </td>            
                                @endif
                            @endfor
                          @endforeach
                          <td>
                            {{ $freight->created_at->format('d/m/Y') }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('fleteras.destroy', $freight->id) }}" method="post">
                              @csrf
                              @method('delete')
                              <a class="btn btn-success btn-link" data-original-title=""
                                href="{{ route('fleteras.edit', $freight) }}" rel="tooltip"
                                title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container">
                                </div>
                              </a>
                              <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar esta relación.?") }}') ? this.parentElement.submit() : ''">
                                <i class="material-icons">close</i>
                                <div class="ripple-container"></div>
                              </button>
                            </form>
                          </td>
                        </tr>
                        @endif
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
@endsection
@push('js')
  <script>

   $(document).ready(function() {
      iniciar_date('datatables');
      iniciar_date('datatables1');
    });
  </script>
@endpush
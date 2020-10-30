@extends('layouts.app', ['page' => __('Gestión de Fleteras'), 'pageSlug' => __('Fleteras')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card bg-blue">
              <div class="card-header card-header-primary">
                <h4 class="card-title text-white">
                  <a href="{{ route('fleteras.index') }}" title="Regresar a la lista">
                    <i class="tim-icons icon-minimal-left text-white"></i>
                  </a>
                  {{ __('Pipas') }}
                </h4>
                <p class="card-category text-white mb-3"> {{ __('Aquí puedes administrar todas las pipas.') }}</p>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  
                  <div class="col-10 text-left">
                   
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('pipas.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar Pipa') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                    <thead class=" text-primary">
                      <th>
                        {{ __('# Economico') }}
                      </th>
                      <th>
                        {{ __('# de Serie') }}
                      </th>
                      <th>
                        {{ __('Capacidad') }}
                      </th>
                      <th>
                        {{ __('Compartimientos') }}
                      </th>
                      <th>
                        {{ __('Compartimiento 1') }}
                      </th>
                      <th>
                        {{ __('Compartimiento 2') }}
                      </th>
                      <th>
                        {{ __('Tractor') }}
                      </th>
                      <th>
                        {{ __('Fecha de Alta') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($pipas as $pipa)
                        <tr>
                          <td>
                            {{ $pipa->numero_economico }}
                          </td>
                          <td>
                            {{ $pipa->numero }}
                          </td>
                          <td>
                            {{ number_format($pipa->capacidad,0) }}L
                          </td>
                          <td class="text-center">
                            {{ $pipa->compartimentos }}
                          </td>
                          <td>
                            {{ number_format($pipa->capacidad_1,0) }}L
                          </td>
                          <td>
                            {{ number_format($pipa->capacidad_2,0) }}L
                          </td>
                          <td>
                            {{ $pipa->tractors->tractor }}L
                          </td>
                          <td>
                            {{ $pipa->created_at->format('d/m/Y') }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('pipas.destroy', $pipa->id) }}" method="post">
                              @csrf
                              @method('delete')
                              <a class="btn btn-success btn-link" data-original-title=""
                                href="{{ route('pipas.edit', $pipa) }}" rel="tooltip"
                                title="">
                                <i class="tim-icons icon-pencil"></i>
                              </a>
                              <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta pipa?") }}') ? this.parentElement.submit() : ''">
                                <i class="tim-icons icon-trash-simple"></i>
                              </button>
                            </form>
                          </td>
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
@endsection
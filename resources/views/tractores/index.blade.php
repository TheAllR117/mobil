@extends('layouts.app', ['page' => __('Gestión de Fleteras'), 'pageSlug' => __('Fleteras')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card bg-danger">
              <div class="card-header card-header-primary">
                <h4 class="card-title text-white">
                  <a href="{{ route('fleteras.index') }}" title="Regresar a la lista">
                    <i class="tim-icons icon-minimal-left text-white"></i>
                  </a>
                  {{ __('Tractores') }}
                </h4>
                <p class="card-category text-white">{{__('Aquí puedes administrar todos los tractores.')}}</p>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row justify-content-end">
                  <div class="col-2 text-right">
                    <a href="{{ route('tractores.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar Tractor') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                    <thead class=" text-primary">
                      <th>
                        {{ __('Tractor') }}
                      </th>

                      <th>
                        {{ __('Placas') }}
                      </th>
                      <th>
                        {{ __('Marca') }}
                      </th>
                      <th>
                        {{ __('Modelo') }}
                      </th>
                      <th>
                        {{ __('Descripcion') }}
                      </th>
                      <th>
                        {{ __('Fecha de Alta') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($tractores as $tractor)
                        <tr>
                          <td>
                            {{ $tractor->tractor }}
                          </td>
                          <td>
                            {{ $tractor->placas }}
                          </td>
                          <td>
                            {{ $tractor->marca }}
                          </td>
                          <td>
                            {{ $tractor->modelo }}
                          </td>
                          <td>
                            {{ $tractor->descripcion }}
                          </td>
                          <td>
                            {{ $tractor->created_at->format('d/m/Y') }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('tractores.destroy', $tractor->id) }}" method="post">
                              @csrf
                              @method('delete')
                              <a class="btn btn-success btn-link" data-original-title=""
                                href="{{ route('tractores.edit', $tractor) }}" rel="tooltip"
                                title="">
                                <i class="tim-icons icon-pencil"></i>
                              </a>
                              <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este tractor?") }}') ? this.parentElement.submit() : ''">
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

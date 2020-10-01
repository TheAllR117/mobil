@extends('layouts.app', ['page' => __('Gestión de Estaciones'), 'pageSlug' => __('Estaciones')])

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 ">
            <div class="card">
              <div class="card-header card-header-primary">
                <div class="row">
                  <div class="col mt-3">
                    <h4 class="card-title ">{{ __('Estaciones') }}</h4>
                    <p class="card-category"> {{ __('Aquí puedes administrar todas las estaciones.') }}</p>
                  </div>
                  <div class="col mt-3">
                    <form action="{{ route('estaciones.import_excel') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
                      @csrf
                      @method('post')
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <input type="date" class="form-control mt-2"  name="fecha_precio_sugerido" required> 
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group form-file-upload form-file-multiple">
                              <input type="file" multiple="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="inputFileHidden" name="select_file" id="input-excel">
                              <div class="input-group">
                                <input type="text" class="form-control inputFileVisible mt-2" placeholder="Selecciona un archivo Excel" id="archivo_excel"> 
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="btn_archivo_excel">
                                  <i class="material-icons">attach_file</i>
                                </button>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <button type="submit" id="archivo_excel_boton" class="mt-3 btn btn-sm btn-danger" disabled>
                              Cargar
                            </button>
                          </div>
                        </div>
                      
                      
                    </form>
                  </div>
                </div>

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
                  <div class="col-12 text-right">
                    @if(auth()->user()->roles[0]->id == 1)
                    <a href="{{ route('estaciones.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar Estación') }}</a>
                    @endif
                  </div>
                </div>
                <div class="">
                    <table id="datatables_1" class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%">
                    <thead class="text-primary">
                      <th tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions: activate to sort column ascending">Nombre</th>
                      <th>CRE</th>
                      <th>Sucursal</th>
                      <th>Crédito</th>
                      <th>Fecha de alta</th>
                      <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 86px;" aria-label="Actions: activate to sort column ascending">Acciones</th>
                    </thead>
                    <tbody>
                      @foreach($estaciones as $estacion)
                        <tr>
                          <td>{{ $estacion->razon_social }}</td>
                          <td>{{ $estacion->cre }}</td>
                         
                          <td>{{ $estacion->nombre_sucursal }}</td>
                          <td>
                            @if($estacion->linea_credito == 1)
                              si
                            @else
                              no
                            @endif
                          </td>
                          <td>
                            {{ $estacion->created_at->format('d/m/Y') }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('estaciones.destroy', $estacion->id) }}" method="post">
                              @csrf
                              @method('delete')
                              <div class="row pt-0 pb-0 mt-0 mb-0">
                                <div class="col-sm-2 mt-0">
                                  @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                                  <a class="btn btn-info btn-link" data-original-title=""
                                    onclick="conseguir_valores({{$estacion->id}},{{$estacion->utilidad_r}},{{$estacion->utilidad_p}},{{$estacion->utilidad_d}});" rel="tooltip"
                                    title="Agregar precio de mañana" id="precio">
                                    <i class="tim-icons icon-coins"></i>
                                  </a>
                                  @endif
                                </div>
                                <div class="col-sm-2 mt-0">
                                  @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 2 )
                                  <a class="btn btn-danger btn-link" data-original-title=""
                                    href="{{ route('estaciones.show', $estacion) }}" rel="tooltip"
                                    title="Ver información de la estación">
                                    <i class="tim-icons icon-paper"></i>
                                  </a>
                                  @endif
                                </div>
                              </div>
                              <div class="row mt-0">
                                <div class="col-sm-2 mt-0">
                                  @if(auth()->user()->roles[0]->id == 1 )
                                  <a class="btn btn-success btn-link" data-original-title=""
                                    href="{{ route('estaciones.edit', $estacion) }}" rel="tooltip"
                                    title="">
                                    <i class="tim-icons icon-pencil"></i>
                                  </a>
                                  @endif
                                </div>
                                <div class="col-sm-2 mt-0">
                                @if(auth()->user()->roles[0]->id == 1 )
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta Estación?") }}') ? this.parentElement.submit() : ''">
                                    <i class="tim-icons icon-trash-simple"></i>
                                  </button>
                                  @endif
                                </div>
                              </div>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!--inputs para las operaciones-->
                <input type="hidden" id="id">
                <input type="hidden" id="utilidad_r">
                <input type="hidden" id="utilidad_p">
                <input type="hidden" id="utilidad_d">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Precios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <input type="hidden" name="id_estacion" id="input-id_estacion">
                          <div class="form-group  col-sm-4">
                            <label for="extra">{{ __('Precio Extra') }}</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="input-extra" aria-describedby="extraHelp"  value="" required="true" aria-required="true" name="extra">
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="supreme">{{ __('Precio Supreme') }}</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="input-supreme" aria-describedby="supremeHelp"  value="" required="true" aria-required="true" name="supreme">
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="diesel">{{ __('Precio Diesel') }}</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="input-diesel" aria-describedby="dieselHelp"  value="" required="true" aria-required="true" name="diesel">
                          </div>

                        </div>
                        <div class="row">

                          <div class="form-group  col-sm-4">
                            <label for="extra_1">{{ __('Extra con utilidad') }}</label>
                            <input type="text" class="form-control" id="input-extra_1" aria-describedby="extra_1Help"  value="0"  aria-required="true" name="extra_1" id="extra_1" disabled>
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="supreme_1">{{ __('Supreme con utilidad') }}</label>
                            <input type="text" class="form-control" id="input-supreme_1" aria-describedby="supreme_1Help"  value="0"  aria-required="true" name="supreme_1" id="supreme_1" disabled>
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="diesel_1">{{ __('Diesel con utilidad') }}</label>
                            <input type="text" class="form-control" id="input-diesel_1" aria-describedby="diesel_1Help"  value="0" aria-required="true" name="diesel_1" id="diesel_1" disabled>
                          </div>

                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="guardar_price">Guardar</button>
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


@extends('layouts.app', ['page' => __('Gestión de los pedidos'), 'pageSlug' => __('Pedidos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card bg-blue">
            <div class="card-header card-header-primary">
              <div class="row">
                <div class="col-sm-6">
                  <h4 class="card-title text-white">{{ __('Pedidos para el día: ') }} {{$fecha}} {{$fecha_sig}}</h4>
                  <p class="card-category text-white mb-3"> {{ __('Aquí puedes administrar todos los pedidos.') }}</p>
                </div>
                <div class="col-sm-6">
                  @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                  <form action="{{ route('pedidos.import_pdf') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('post')
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input type="text" class="form-control datetimepicker bg-white mt-2" id="input-dia_entrega" name="dia_entrega" value="10/05/2018"/>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group form-file-upload form-file-multiple">
                          <input type="file" multiple="" accept="application/pdf" class="inputFileHidden" name="select_file" id="input-pdf">
                          <div class="input-group">
                            <input type="text" class="form-control inputFileVisible bg-white mt-2" placeholder="Selecciona un archivo PDF" id="archivo_pdf"> 
                            <button type="button" class="btn btn-sm btn-primary mt-2" id="btn_archivo_excel">
                              <i class="material-icons">attach_file</i>
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <button type="submit" id="archivo_pdf_boton" class="mt-3 btn btn-sm btn-primary" disabled>
                          Cargar
                        </button>
                      </div>
                    </div>
                  </form>
                  @endif
                </div>
              </div>
            </div>
          </div>
            <div class="card">
              
              <div class="card-body">
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="nav-item">
                        <a class="nav-link active" href="#link1" data-toggle="tab">Pedidos Pendientes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#link2" data-toggle="tab">Pedidos Autorizados</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#link3" data-toggle="tab">Pedidos en Camino</a>
                      </li>
                      @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                      <li class="nav-item">
                        <a class="nav-link" href="#link4" data-toggle="tab">Fletes en Camino</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#link5" data-toggle="tab">Pedidos Cancelados</a>
                      </li>
                      @endif
                    </ul>
                  </div>
                </div>
               
                <div class="tab-content tab-space">
                  <div class="tab-pane active" id="link1" aria-expanded="true">
                    <!--Tabla 1 pedidos realizados-->
                    <div class="row">
                      <div class="col-12 text-right">
                        @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                        <a class="btn btn-sm btn-primary" href="{{ route('exportar_excel') }}">Descargar Excel</a>
                        @endif
                        <a href="{{ route('pedidos.create') }}" class="btn btn-sm btn-primary">{{ __('Hacer Pedido') }}</a>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                        <thead class=" text-primary">
                              <th>{{ __('MO') }}</th>
                              <th>{{ __('SO Number') }}</th>
                              <th>{{ __('Sucursal') }}</th>
                              <th>{{ __('Producto') }}</th>
                              <th>{{ __('Litros') }}</th>
                              <th>{{ __('Costo') }}</th>
                              <th>{{ __('Fecha de entrega solicitada') }}</th>
                              <th class="text-center th-actions">{{ __('Acciones') }}</th>
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                          
                            @if($order->status_id == 1)
                            <tr>
                              <td>{{ $order->po }}</td>
                              <td>{{ $order->so_number }}</td>
                              <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $order->producto }}</td>
                              <td>{{ number_format($order->cantidad_lts, 0) }}L</td>
                              <td>${{ number_format($order->costo_aprox, 2) }}</td>
                              <td>{{ $order->dia_entrega }}</td>
                              <td class="td-actions">
                                <form action="{{ route('pedidos.destroy', $order->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                                  <a class="btn btn-just-icon btn-link sonomber" title="Asignar SO Number" data-original-title="" rel="tooltip" id="precio" onclick="so_number('{{ $order->id }}','{{ $order->estacions[0]->nombre_sucursal }}');">
                                    <i class="tim-icons icon-check-2 text-success"></i>
                                  </a>
                                  @endif
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title=" Eliminar Pedido" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este pedido?") }}') ? this.parentElement.submit() : ''">
                                    <i class="tim-icons icon-trash-simple"></i>
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

                  <div class="tab-pane" id="link2" aria-expanded="false">
                    <!--Tabla 2 con sonumber asignado-->
                    <div class="row">
                      @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                      <div class="col-12 text-right">
                        <a href="{{ route('control.create') }}" class="btn btn-sm btn-primary">{{ __('Armar envio') }}</a>
                      </div>
                      @endif
                    </div>
                    <div class="table-responsive">
                      <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_2">
                        <thead class=" text-primary">
                          
                              <th>{{ __('MO') }}</th>
                              <th>{{ __('SO Number') }}</th>
                              <th>{{ __('Sucursal') }}</th>
                              <th>{{ __('Producto') }}</th>
                              <th>{{ __('Litros') }}</th>
                              <th>{{ __('Costo') }}</th>
                              <th>{{ __('Factura A') }}</th>
                              <th>{{ __('Fecha de entrega solicitada') }}</th>
                          
                          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                          <th class="text-center th-actions">{{ __('Acciones') }}</th>
                          @endif
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                            @if($order->status_id == 2)
                            <tr>
                              <td>{{ $order->po }}</td>
                              <td>{{ $order->so_number }}</td>
                              <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $order->producto }}</td>
                              <td>{{ number_format($order->cantidad_lts, 0) }}L</td>
                              <td>${{ number_format($order->costo_aprox, 2) }}</td>
                              <td>{{ $order->factura_a }}</td>
                              <td>{{ $order->dia_entrega }}</td>
                              @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                              <td class="td-actions">
                                <form action="{{ route('pedidos.destroy_order', $order->id) }}" method="post">
                                  @csrf
                                  @method('delete')

                                  @foreach($freights as $freight )
                                    @if($order->estacion_id == $freight->id_estacion )
                                    <a class="btn btn-social btn-just-icon btn-link enviar" title="Enviar" data-original-title="" rel="tooltip" id="boton_enviar" onclick="autorizar('{{ $order->estacion_id }}','{{ $order->estacions[0]->nombre_sucursal }}','{{ $order->id }}');">
                                      <i class="material-icons">local_shipping</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    @break
                                    @endif
                                  @endforeach

                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas cancelar este pedido?") }}') ? this.parentElement.submit() : ''">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                  </button>
                                </form>
                              </td>
                              @endif
                            </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                  </div>

                  <div class="tab-pane" id="link3" aria-expanded="false">
                    <!-- pedidos en camino -->
                    <div class="table-responsive">
                      <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_3">
                        <thead class=" text-primary">
                          <th>{{ __('N° de Orden') }}</th>
                          <th>{{ __('MO') }}</th>
                          <th>{{ __('SO Number') }}</th>
                          <th>{{ __('sucursal ') }}</th>
                          <th>{{ __('Producto ') }}</th>
                          <th>{{ __('Litros ') }}</th>
                          <th>{{ __('Costo ') }}</th>
                          <th>{{ __('Factura A ') }}</th>
                          <!--th>{{ __('Estatus ') }}</th-->
                          <th>{{ __('Fecha de entrega solicitada ') }}</th>
                          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                          <th class="text-center th-actions">{{ __('Acciones ') }}</th>
                          @endif
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                            @if($order->status_id == 3)
                            <tr>
                              <td>{{ $order->controls[0]->id }}</td>
                              <td>{{ $order->po }}</td>
                              <td>{{ $order->so_number }}</td>
                              <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $order->producto }}</td>
                              <td>{{ number_format($order->cantidad_lts, 0) }}L</td>
                              <td>${{ number_format($order->costo_aprox, 2) }}</td>
                              <td>{{ $order->factura_a }}</td>
                              <td>{{ $order->dia_entrega }}</td>
                              @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                              <td class="td-actions">
                                <form action="{{ route('pedidos.destroy', $order->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="btn btn-social btn-just-icon btn-link" data-original-title="" href="{{ route('pedidos.cambiar_status', $order) }}" rel="tooltip" title="Concluir pedido">
                                    <i class="material-icons">check_circle_outline</i>
                                    <div class="ripple-container">
                                    </div>
                                  </a>
                                <a class="btn btn-success btn-link emergencia" data-original-title="" rel="tooltip" title="Cambiar por otro pedido" onclick="envio_emergencia('{{$order->id}}');">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container">
                                  </div>
                                </a>
                                </form>
                              </td>
                              @endif
                            </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                  </div>

                  <div class="tab-pane" id="link4" aria-expanded="false">

                    <div class="table-responsive">
                      <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_4">
                        <thead class=" text-primary">
                          <th>{{ __('N° de Orden') }}</th>
                          <th>{{ __('Fletera') }}</th>
                          <th>{{ __('Tractor') }}</th>
                          <th>{{ __('Pipa 1') }}</th>
                          <th>{{ __('Pipa 2') }}</th>
                          <th>{{ __('Conductor') }}</th>
                          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                            <th class="text-center th-actions">{{ __('Acciones') }}</th>
                          @endif
                        </thead>
                        <tbody>
                          @foreach($controls as $control)
                            @switch(count($control->orders))
                              @case(1)
                                @if(($control->orders[0]->status_id == 4) or ($control->orders[0]->status_id == 3))
                                  <tr>
                                    <td>{{ $control->id }}</td>
                                    <td>
                                      @if($control->freights[0]->namefreights == '[]')
                                        {{ $control->freights[0]->estacions[0]->nombre_sucursal }}
                                      @else
                                        {{ $control->freights[0]->namefreights[0]->name  }}
                                      @endif
                                    </td>
                                    <td>{{ $control->tractors->placas }}</td>

                                    <td>{{ $control->orders[0]->pipes->numero_economico}}</td>
                                    <td>{{ __('No hay segunda pipa') }}</td>

                                    <td>{{$control->driver->name}}</td>
                                    @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                                      <td class="td-actions">
                                        @if ($control->orders[0]->status_id == 4)
                                          <form action="{{ route('pedidos.liberar_flete') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-success btn-link" data-original-title="" title="Liberar Flete" onclick="confirm('{{ __("¿Estás seguro de liberar el flete?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">lock_open</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                        @else
                                          <form action="{{ route('control.create', $control->id) }}" method="post">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="btn btn-success btn-link">
                                              <i class="material-icons">edit</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                          <form action="{{ route('pedidos.eliminar') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este pedido?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>    
                                        @endif
                                      </td>
                                    @endif
                                  </tr>
                                @endif
                              @break
                              @case(2)
                                @if(($control->orders[0]->status_id == 4 && $control->orders[1]->status_id == 4) or ($control->orders[0]->status_id == 3 || $control->orders[1]->status_id == 3))
                                  <tr>
                                    <td>{{ $control->id }}</td>
                                    <td>
                                      @if($control->freights[0]->namefreights == '[]')
                                        {{ $control->freights[0]->estacions[0]->nombre_sucursal }}
                                      @else
                                        {{ $control->freights[0]->namefreights[0]->name  }}
                                      @endif
                                    </td>
                                    <td>{{ $control->tractors->placas }}</td>

                                    <td>{{ $control->orders[0]->pipes->numero_economico}}</td>
                                    @if ($control->orders[1]->pipe_id != null and $control->orders[1]->pipe_id != $control->orders[0]->pipe_id )
                                      <td>{{ $control->orders[1]->pipes->numero_economico}}</td>    
                                    @else
                                      <td>{{ __('No hay segunda pipa') }}</td>    
                                    @endif

                                    <td>{{$control->driver->name}}</td>
                                    @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                                      <td class="td-actions">
                                        @if ($control->orders[0]->status_id == 4 && $control->orders[1]->status_id == 4)
                                          <form action="{{ route('pedidos.liberar_flete') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-success btn-link" data-original-title="" title="Liberar Flete" onclick="confirm('{{ __("¿Estás seguro de liberar el flete?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">lock_open</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                        @else
                                          <form action="{{ route('control.create', $control->id) }}" method="post">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="btn btn-success btn-link">
                                              <i class="material-icons">edit</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                          <form action="{{ route('pedidos.eliminar') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este pedido?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>    
                                        @endif
                                      </td>
                                    @endif
                                  </tr>
                                @endif
                              @break
                              @case(3)
                                @if(($control->orders[0]->status_id == 4 && $control->orders[1]->status_id == 4 && $control->orders[2]->status_id == 4) or ($control->orders[0]->status_id == 3 || $control->orders[1]->status_id == 3 || $control->orders[2]->status_id == 3))
                                  <tr>
                                    <td>{{ $control->id }}</td>
                                    <td>
                                      @if($control->freights[0]->namefreights == '[]')
                                        {{ $control->freights[0]->estacions[0]->nombre_sucursal }}
                                      @else
                                        {{ $control->freights[0]->namefreights[0]->name  }}
                                      @endif
                                    </td>
                                    <td>{{ $control->tractors->placas }}</td>
                                    
                                    <td>{{ $control->orders[0]->pipes->numero_economico}}</td>
                                    <td>{{ $control->orders[2]->pipes->numero_economico}}</td>

                                    <td>{{$control->driver->name}}</td>
                                    @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                                      <td class="td-actions">
                                        @if ($control->orders[0]->status_id == 4 && $control->orders[1]->status_id == 4 && $control->orders[2]->status_id == 4)
                                          <form action="{{ route('pedidos.liberar_flete') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-success btn-link" data-original-title="" title="Liberar Flete" onclick="confirm('{{ __("¿Estás seguro de liberar el flete?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">lock_open</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                        @else
                                        <form action="{{ route('control.create', $control->id) }}" method="post">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="btn btn-success btn-link">
                                              <i class="material-icons">edit</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                          <form action="{{ route('pedidos.eliminar') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este pedido?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>    
                                        @endif
                                      </td>
                                    @endif
                                  </tr>
                                @endif
                              @break
                              @case(4)
                                @if(($control->orders[0]->status_id == 4 && $control->orders[1]->status_id == 4 && $control->orders[2]->status_id == 4 && $control->orders[3]->status_id == 4) or ($control->orders[0]->status_id == 3 || $control->orders[1]->status_id == 3 || $control->orders[2]->status_id == 3 || $control->orders[3]->status_id == 3))
                                  <tr>
                                    <td>{{ $control->id }}</td>
                                    <td>
                                      @if($control->freights[0]->namefreights == '[]')
                                        {{ $control->freights[0]->estacions[0]->nombre_sucursal }}
                                      @else
                                        {{ $control->freights[0]->namefreights[0]->name  }}
                                      @endif
                                    </td>
                                    <td>{{ $control->tractors->placas }}</td>

                                    <td>{{ $control->orders[0]->pipes->numero_economico}}</td>
                                    <td>{{ $control->orders[3]->pipes->numero_economico}}</td>

                                    <td>{{$control->driver->name}}</td>
                                    @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                                      <td class="td-actions">
                                        @if ($control->orders[0]->status_id == 4 && $control->orders[1]->status_id == 4 && $control->orders[2]->status_id == 4 && $control->orders[3]->status_id == 4)
                                          <form action="{{ route('pedidos.liberar_flete') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-success btn-link" data-original-title="" title="Liberar Flete" onclick="confirm('{{ __("¿Estás seguro de liberar el flete?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">lock_open</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>    
                                        @else
                                          <form action="{{ route('control.create', $control->id) }}" method="post">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="btn btn-success btn-link">
                                              <i class="material-icons">edit</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                          <form action="{{ route('pedidos.eliminar') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{$control->id}}">
                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este pedido?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                            </button>
                                          </form>    
                                        @endif
                                      </td>
                                    @endif
                                  </tr>
                                @endif
                              @break
                            @endswitch
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                  </div>
                  <div class="tab-pane" id="link5" aria-expanded="false">
                    <div class="table-responsive">
                      <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_5">
                        <thead class=" text-primary">
                          <th>{{ __('SO Number') }}</th>
                          <th>{{ __('Estación') }}</th>
                          <th>{{ __('Nombre de la sucursal') }}</th>
                          <th>{{ __('Producto') }}</th>
                          <th>{{ __('Cantidad LTS.') }}</th>
                          <th>{{ __('Costo Aprox') }}</th>
                          <th>{{ __('Fecha de vencimiento') }}</th>
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                            @if($order->status_id == 6)
                            <tr>
                              <td>{{ $order->so_number }}</td>
                              <td>{{ $order->estacions[0]->razon_social}}</td>
                              <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $order->producto }}</td>
                              <td>{{ number_format($order->cantidad_lts, 0) }}L</td>
                              <td>${{ number_format($order->costo_aprox, 2) }}</td>
                              <td>{{ $order->fecha_eliminacion }}</td>
                            </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar SO Number</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <input type="hidden" name="id_estacion" id="input-id_estacion">
                          <div class="form-group  col-sm-4">
                            <label for="estacion_id">{{ __('ID') }}</label>
                            <input type="text" class="form-control" id="input-estacion_id" aria-describedby="estacion_idHelp"  value="" required="true" aria-required="true" name="estacion_id">
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="supreme">{{ __('Estación') }}</label>
                            <input type="text" class="form-control" id="input-estacion" aria-describedby="supremeHelp"  value="" required="true" aria-required="true" name="estacion">
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="diesel">{{ __('SO Number') }}</label>
                            <input type="text" class="form-control" id="input-so_number" aria-describedby="dieselHelp"  value="" required="true" aria-required="true" name="so_number">
                          </div>

                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="guardar_so">Guardar</button>
                      </div>
                     
                    </div>
                  </div>
                </div>


                <!-- Modal 2 autorizar envio-->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form action="{{ route('pedidos.individual') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('post')
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Enviar</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <input type="hidden" name="order_id" id="order_id">
                            <div class="form-group  col-sm-6">
                              <label for="id">{{ __('ID') }}</label>
                              <input type="text" class="form-control" name="id" id="input-id">
                            </div>
                            <div class="form-group  col-sm-6">
                              <label for="estacion_name">{{ __('Estación') }}</label>
                              <input type="text" class="form-control" id="input-estacion_name" aria-describedby="estacion_nameHelp"  value="" required="true" aria-required="true" name="estacion_name">
                            </div>
                            <div class="form-group{{ $errors->has('id_estacion') ? ' has-danger' : '' }} mt-2 pr-1 pl-0 col-sm-4 text-center">
                              <label class="label-control" for="id_estacion">Terminal</label><br>
                              <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-terminal_id" data-width="100%" name="terminal_id">
                                <option disabled selected>Elije</option>
                                @foreach($terminals as $terminal)
                                <option value="{{ $terminal->id }}">{{ $terminal->razon_social }}</option>
                                @endforeach
                              </select><br>
                              @if ($errors->has('id_estacion'))
                                <span class="error text-danger" for="input-id_estacion" id="id_estacion-error">
                                  {{ $errors->first('id_estacion') }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group{{ $errors->has('id_estacion') ? ' has-danger' : '' }} mt-2 pr-0 pl-0 col-sm-4 text-center">
                              <label class="label-control" for="id_estacion">Chofer</label><br>
                              <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-id_chofer" data-width="100%" name="id_chofer">
                                <option disabled selected>Elije</option>
                                @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                                @foreach($choferes as $chofer)
                                <option value="{{ $chofer->id }}">{{ $chofer->name  }}</option>
                                @endforeach
                                @endif
                              </select><br>
                              @if ($errors->has('id_estacion'))
                                <span class="error text-danger" for="input-id_estacion" id="id_estacion-error">
                                  {{ $errors->first('id_estacion') }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group{{ $errors->has('id_estacion') ? ' has-danger' : '' }} mt-2 pr-0 pl-1 col-sm-4 text-center">
                              <label class="label-control" for="id_estacion">Pipa</label><br>
                              <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-id_pipe" data-width="100%" name="id_pipe">
                                <option disabled selected>Elije</option>
                              </select><br>
                              @if ($errors->has('id_estacion'))
                                <span class="error text-danger" for="input-id_estacion" id="id_estacion-error">
                                  {{ $errors->first('id_estacion') }}
                                </span>
                              @endif
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary" id="">Enviar</button>
                        </div>
                     </form>
                    </div>
                  </div>
                </div>


                <!-- Modal 3 envio de emergencia-->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form action="{{ route('pedidos.emergencia') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('post')
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Enviar de emergencia</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="form-group  col-sm-12 text-center">
                              <p>Introduce el sonumber del pedido que deseas que remplace a este.</p>
                            </div>
                          </div>
                          <div class="row">
                            <input type="hidden" name="order_id_e" id="order_id_e">
                            <div class="form-group  col-sm-12">
                              <label for="id">{{ __('SO Number') }}</label>
                              <input type="text" class="form-control" name="id" id="input-id">
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary" id="">Enviar</button>
                        </div>
                     </form>
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

    $('#guardar_so').click(function(){
      $.ajax({
        url: 'pedidos/sonomber',
        type: 'POST',
        dataType: 'json',
        data: {
          '_token': $('input[name=_token]').val(),
          'id' : $("#input-estacion_id").val(),
          'status_id' : '2',
          'so_number': $("#input-so_number").val(),
        },
        headers:{ 
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response){
          $('#exampleModal').modal('toggle');
          // alert(response);
          demo.showNotification('top','center', response, 'tim-icons icon-bell-55');
          location.reload(true);
        }
      });
    });

    $(".sonomber").click(function() {
      //data-toggle="modal" data-target="#exampleModal"
      $('#exampleModal').modal('toggle');

      $('#exampleModal').on('hidden.bs.modal', function (e) {
        
      })
    });

    $(".enviar").click(function() {
      //data-toggle="modal" data-target="#exampleModal"
      $('#exampleModal1').modal('toggle');

      $('#exampleModal1').on('hidden.bs.modal', function (e) {
        
      })
    });

    $(".emergencia").click(function() {
      //data-toggle="modal" data-target="#exampleModal"
      $('#exampleModal2').modal('toggle');

      $('#exampleModal2').on('hidden.bs.modal', function (e) {
        
      })
    });

    $(".estatus_pedido").change(function() {
        var id_pedido = $(this).children("option:selected").attr("data_id");
        var pedido = $(this).children("option:selected").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'pedidos/updateEstatus',
            type: 'POST',
            dataType: 'json',
            data: {
              'id_pedido' : id_pedido,
              'camino' : pedido,
            },
            success: function(response){
                console.log(response);
              
            }
        });
    });

   $(document).ready(function() {
      init_calendar('input-dia_entrega','01-01-2020', '07-07-2025');
    });
  </script>
@endpush
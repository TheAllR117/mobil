@extends('layouts.app', ['page' => __('Gestión de los abonos'), 'pageSlug' => __('Abonos')])

@section('content')

@if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
<ul class="nav nav-tabs-navigation nav-pills nav-pills-primary nav-pills-icons mb-5" role="tablist">
  <li class="nav-item col-sm-4 pl-0">
    <a class="nav-link active show" data-toggle="tab" href="#link10">
      <i class="tim-icons icon-istanbul"></i>Abonos
    </a>
  </li>
  <li class="nav-item col-sm-4">
    <a class="nav-link" data-toggle="tab" href="#link11">
      <i class="tim-icons icon-settings"></i>Abonos Pedidos
    </a>
  </li>
  <li class="nav-item col-sm-4 pr-0">
    <a class="nav-link" data-toggle="tab" href="#link12">
      <i class="tim-icons icon-settings"></i>Abonos Facturas Diversas
    </a>
  </li>
</ul>
@endif
<div class="row">
  <div class="col-sm-12">
    <div class="tab-content">
      <div class="tab-pane active show" id="link10">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('abonos.create') }}" class="btn btn-sm btn-primary">{{ __('Hacer Abono') }}</a>
                  </div>
                </div>

                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="nav-item">
                        <a class="nav-link active" href="#link1" data-toggle="tab">Abonos Pendientes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#link2" data-toggle="tab">Abonos Autorizados</a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="tab-content tab-space">
                  <div class="tab-pane active" id="link1" aria-expanded="true">
                    <div class="material-datatables">
                      <table cellspacing="0" class="table table-striped table-no-bordered table-hover"
                        id="datatables_1" style="width:100%" width="100%">
                        <thead class=" text-primary">
                          <th>{{ __('Estación') }}</th>
                          <th>{{ __('Nombre Sucursal') }}</th>
                          <th>{{ __('Cantidad $') }}</th>
                          <th>{{ __('Archivo') }}</th>
                          <th>{{ __('Estatus') }}</th>
                          <th>{{ __('Fecha de solicitud') }}</th>

                          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                          <th class="text-center th-actions">{{ __('Acciones') }}</th>
                          @endif
                        </thead>
                        <tbody>
                          @foreach($payments as $payment)
                            @if($payment->statu_orders->id == 1 )
                            <tr>
                              <td>{{ $payment->estacions[0]->razon_social }}</td>
                              <td>{{ $payment->estacions[0]->nombre_sucursal }}</td>
                              <td>${{ number_format($payment->cantidad, 2) }}</td>
                              <td><img src="{{ url('storage/abonos/'.$payment->id_estacion.'/'.$payment->url) }}" onclick="imagen_mostrar('{{ url('storage/abonos/'.$payment->id_estacion.'/'.$payment->url) }}');" style="width: 60px;" data-toggle="modal" data-target="#exampleModalLong" title="click para ampliar." /></td>
                              <td>{{ $payment->statu_orders->name }}</td>
                              <td>{{ $payment->created_at->format('d/m/Y') }}</td>

                              @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                              <td class="td-actions">
                                <form action="{{ route('abonos.destroy', $payment->id) }}" method="post">
                                  @csrf
                                  @method('delete')

                                  <a class="btn btn-link" title="Validar Abono" data-original-title="" rel="tooltip" id="precio" onclick="cargar_id('{{ $payment->id_estacion }}','{{ $payment->id }}','{{ $payment->estacions[0]->nombre_sucursal }}','{{$payment->cantidad}}');">
                                    <i class="tim-icons icon-check-2 text-success"></i>
                                  </a>
                                
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar Abono" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta pipa?") }}') ? this.parentElement.submit() : ''">
                                    <i class="tim-icons icon-trash-simple"></i> 
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
                  <div class="tab-pane" id="link2" aria-expanded="true">

                    <div class="material-datatables">
                      <table cellspacing="0" class="table table-striped table-no-bordered table-hover"
                        id="datatables_2" style="width:100%" width="100%">
                        <thead class=" text-primary">
                          <th>{{ __('Estación') }}</th>
                          <th>{{ __('Nombre Sucursal') }}</th>
                          <th>{{ __('Cantidad $') }}</th>
                          <th>{{ __('Archivo') }}</th>
                          <th>{{ __('Estatus') }}</th>
                          <th>{{ __('Fecha de Aprobación') }}</th>
                          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                          <th class="text-center th-actions">{{ __('Acciones') }}</th>

                          @endif
                        </thead>
                        <tbody>
                          @foreach($payments as $payment)
                            @if($payment->statu_orders->id == 2 )
                              <tr>
                                <td>{{ $payment->estacions[0]->razon_social }}</td>
                                <td>{{ $payment->estacions[0]->nombre_sucursal }}</td>
                                <td>${{ number_format($payment->cantidad, 2) }}</td>
                                <td><img src="{{ url('storage/abonos/'.$payment->id_estacion.'/'.$payment->url) }}" onclick="imagen_mostrar('{{ url('storage/abonos/'.$payment->id_estacion.'/'.$payment->url) }}');" style="width: 60px;" data-toggle="modal" data-target="#exampleModalLong" title="click para ampliar." /></td>
                                <td>{{ $payment->statu_orders->name }}</td>
                                <td>{{ $payment->updated_at->format('d/m/Y') }}</td>
                                @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                                <td class="td-actions">
                                  <form action="{{ route('abonos.destroy', $payment->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                  
                                    <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar Abono" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta pipa?") }}') ? this.parentElement.submit() : ''">
                                      <i class="tim-icons icon-trash-simple"></i> 
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="link11">
        <div class="row justify-content-center">
          <div class="col-md-12 col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="nav-item">
                        <a class="nav-link active" href="#link3" data-toggle="tab">Abonos Pendientes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#link4" data-toggle="tab">Abonos Autorizados</a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="tab-content tab-space">
                  <div class="tab-pane active" id="link3" aria-expanded="true">
                    <div class="material-datatables">
                      <table cellspacing="0" class="table table-no-bordered table-hover"
                        id="datatables_3"  width="100%">
                        <thead class=" text-primary">
                          <th>{{ __('Sucursal') }}</th>
                          <th>{{ __('MO') }}</th>
                          <th>{{ __('Producto') }}</th>
                          <th>{{ __('Costo') }}</th>
                          <th>{{ __('Abonado hasta el momento') }}</th>
                          <th>{{ __('Cantidad Abonada') }}</th>
                          <th>{{ __('Archivo') }}</th>
                          <th>{{ __('status') }}</th>
                          <th>{{ __('Fecha de Expiración') }}</th>
                          <th>{{ __('Fecha de solicitud') }}</th>
                          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                          <th class="text-center th-actions">{{ __('Acciones') }}</th>
                          @endif
                        </thead>
                        <tbody>
                          @foreach($order_payments as $order_payment)
                            @if($order_payment->id_status == 1 )
                            <tr>
                              <td>{{ $order_payment->order->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $order_payment->order->po }}</td>
                              <td>{{ $order_payment->order->producto }}</td>
                              <td>${{ number_format($order_payment->order->costo_real, 2) }}</td>
                              <td>${{ number_format($order_payment->order->total_abonado, 2) }}</td>
                              <td>${{ number_format($order_payment->cantidad, 2) }}</td>
                              <td><img src="{{ url('storage/order_payments/'.$order_payment->order->estacions[0]->id.'/'.$order_payment->url) }}" onclick="imagen_mostrar('{{ url('storage/order_payments/'.$order_payment->order->estacions[0]->id.'/'.$order_payment->url) }}');" style="width: 60px;" data-toggle="modal" data-target="#exampleModalLong" title="click para ampliar." /></td>
                              <td>{{ $order_payment->status[0]->name }}</td>
                              <td>{{ date("d/m/Y", strtotime($order_payment->order->fecha_expiracion)) }}</td>
                              <td>{{ $order_payment->created_at->format('d/m/Y') }}</td>
                              <td class="td-actions text-right">
                                <form action="{{ route('pagos_pedidos.destroy', $order_payment->id) }}" method="post">
                                  @csrf
                                  @method('delete')

                                  <a class="btn btn-link" title="Validar Abono" data-original-title="" rel="tooltip" id="precio" onclick="cargar_data_pedidos({{$order_payment->id}}, {{$order_payment->cantidad}})">
                                    <i class="tim-icons icon-check-2 text-info"></i>
                                  </a>
                                
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar Abono" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este abono?") }}') ? this.parentElement.submit() : ''">
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
                  <div class="tab-pane" id="link4" aria-expanded="true">

                  <div class="material-datatables">
                      <table cellspacing="0" class="table table-no-bordered table-hover"
                        id="datatables_4"  width="100%">
                        <thead class=" text-primary">
                          <th>{{ __('Sucursal') }}</th>
                          <th>{{ __('MO') }}</th>
                          <th>{{ __('Producto') }}</th>
                          <th>{{ __('Costo') }}</th>
                          <th>{{ __('Abonado hasta el momento') }}</th>
                          <th>{{ __('Cantidad Abonada') }}</th>
                          <th>{{ __('Archivo') }}</th>
                          <th>{{ __('status') }}</th>
                          <th>{{ __('Fecha de Expiración') }}</th>
                          <th>{{ __('Fecha de solicitud') }}</th>
                        </thead>
                        <tbody>
                          @foreach($order_payments as $order_payment)
                            @if($order_payment->id_status == 2 )
                            <tr>
                              <td>{{ $order_payment->order->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $order_payment->order->po }}</td>
                              <td>{{ $order_payment->order->producto }}</td>
                              <td>${{ number_format($order_payment->order->costo_real, 2) }}</td>
                              <td>${{ number_format($order_payment->order->total_abonado, 2) }}</td>
                              <td>${{ number_format($order_payment->cantidad, 2) }}</td>
                              <td><img src="{{ url('storage/order_payments/'.$order_payment->order->estacions[0]->id.'/'.$order_payment->url) }}" onclick="imagen_mostrar('{{ url('storage/order_payments/'.$order_payment->order->estacions[0]->id.'/'.$order_payment->url) }}');" style="width: 60px;" data-toggle="modal" data-target="#exampleModalLong" title="click para ampliar." /></td>
                              <td>{{ $order_payment->status[0]->name }}</td>
                              <td>{{ date("d/m/Y", strtotime($order_payment->order->fecha_expiracion)) }}</td>
                              <td>{{ $order_payment->created_at->format('d/m/Y') }}</td>                  
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
      </div>
      <div class="tab-pane" id="link12">
        <div class="row justify-content-center">
          <div class="col-md-12 col-sm-12">
            
            <div class="card">
              <div class="card-body">
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="nav-item">
                        <a class="nav-link active" href="#link5" data-toggle="tab">Abonos Pendientes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#link6" data-toggle="tab">Abonos Autorizados</a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="tab-content tab-space">
                  <div class="tab-pane active" id="link5" aria-expanded="true">
                    <div class="material-datatables">
                      <table cellspacing="0" class="table table-no-bordered table-hover"
                        id="datatables_5"  width="100%">
                        <thead class=" text-primary">
                          <th>{{ __('Sucursal') }}</th>
                          <th>{{ __('Descripción') }}</th>
                          <th>{{ __('Costo') }}</th>
                          <th>{{ __('Cantidad Abonada') }}</th>
                          <th>{{ __('Archivo') }}</th>
                          <th>{{ __('Fecha de solicitud') }}</th>
                          @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                          <th class="text-center th-actions">{{ __('Acciones') }}</th>
                          @endif
                        </thead>
                        <tbody>
                          @foreach($different_bill_payments as $different_bill_payment)
                            @if($different_bill_payment->id_status == 1 )
                            <tr>
                              <td>{{ $different_bill_payment->differentbills->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $different_bill_payment->differentbills->description }}</td>
                              <td>${{ number_format($different_bill_payment->differentbills->quantity, 2) }}</td>
                              <td>${{ number_format($different_bill_payment->cantidad, 2) }}</td>
                              <td><img  src="{{ url('storage/bill_payment/'.$different_bill_payment->differentbills->id_estacion.'/'.$different_bill_payment->url) }}"  style="width: 40px;" data-toggle="modal" data-target="#exampleModalLong" title="click para ampliar." onclick="imagen_mostrar('{{ url('storage/bill_payment/'.$different_bill_payment->differentbills->id_estacion.'/'.$different_bill_payment->url) }}');"/></td>
                              <td>{{$different_bill_payment->created_at->format('d/m/Y')}}</td>
                              <td class="td-actions text-right">
                                <form action="{{ route('facturas_diferentes.destroy_payment', $different_bill_payment->id) }}" method="post">
                                  @csrf
                                  @method('delete')

                                  <a class="btn btn-link" title="Validar Abono" data-original-title="" rel="tooltip" id="precio" onclick="cargar_data_factura({{$different_bill_payment->id}},{{$different_bill_payment->cantidad}})">
                                    <i class="tim-icons icon-check-2 text-dark facturas_diferentes"></i>
                                  </a>
                                
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar Abono" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar este abono?") }}') ? this.parentElement.submit() : ''">
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
                  <div class="tab-pane" id="link6" aria-expanded="true">

                    <div class="material-datatables">
                      <table cellspacing="0" class="table table-no-bordered table-hover"
                        id="datatables_6"  width="100%">
                        <thead class=" text-primary">
                          <th>{{ __('Sucursal') }}</th>
                          <th>{{ __('Descripción') }}</th>
                          <th>{{ __('Costo') }}</th>
                          <th>{{ __('Cantidad Abonada') }}</th>
                          <th>{{ __('Archivo') }}</th>
                          <th>{{ __('Fecha de solicitud') }}</th>
                        </thead>
                        <tbody>
                          @foreach($different_bill_payments as $different_bill_payment)
                            @if($different_bill_payment->id_status == 2 )
                            <tr>
                              <td>{{ $different_bill_payment->differentbills->estacions[0]->nombre_sucursal }}</td>
                              <td>{{ $different_bill_payment->differentbills->description }}</td>
                              <td>${{ number_format($different_bill_payment->differentbills->quantity, 2) }}</td>
                              <td>${{ number_format($different_bill_payment->cantidad, 2) }}</td>
                              <td><img  src="{{ url('storage/bill_payment/'.$different_bill_payment->differentbills->id_estacion.'/'.$different_bill_payment->url) }}"  style="width: 40px;" data-toggle="modal" data-target="#exampleModalLong" title="click para ampliar." onclick="imagen_mostrar('{{ url('storage/bill_payment/'.$different_bill_payment->differentbills->id_estacion.'/'.$different_bill_payment->url) }}');"/></td>
                              <td>{{$different_bill_payment->created_at->format('d/m/Y')}}</td>
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
      </div>
    </div>
  </div>    
</div>






  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Abono</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <input type="hidden" name="id_order" id="input-id_order">
          <input type="hidden" id="input-estacion_id" name="estacion_id">

          <div class="form-group  col-sm-6">
            <label for="estacion_id">{{ __('Sucursal') }}</label>
            <input type="text" class="form-control" id="input-estacion" aria-describedby="estacion_idHelp"  value="" required="true" aria-required="true" name="estacion" disabled>
          </div>

          <div class="form-group  col-sm-6">
            <label for="diesel">{{ __('Cantidad') }}</label>
            <input type="number" min="0" step="0.1" class="form-control" id="input-cantidad" aria-describedby="dieselHelp"  value="" required="true" aria-required="true" name="cantidad">
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

<!-- Modal pagos pedidos -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('facturas.update') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
      @csrf
      @method('post')
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar Abono de Este Pedido</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="form-group  col-sm-6">
              <label for="diesel">{{ __('ID Pedido') }}</label>
              <input type="text"  class="form-control" id="id_order" value="" required="true" aria-required="true" name="id">
            </div>
            
            <div class="form-group  col-sm-6">
              <label for="diesel">{{ __('Cantidad Abonada') }}</label>
              <input type="number" min="1" class="form-control" id="cantidad" aria-describedby="dieselHelp"  value="" required="true" aria-required="true" name="cantidad">
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="guardar_so">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal pagos pedidos -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('facturas_diferentes.update') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
      @csrf
      @method('post')
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar Abono de Esta Factura</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="form-group  col-sm-6">
              <label for="diesel">{{ __('ID Factura') }}</label>
              <input type="text"  class="form-control" id="id_f" value="" required="true" aria-required="true" name="id">
            </div>
            
            <div class="form-group  col-sm-6">
              <label for="diesel">{{ __('Cantidad Abonada') }}</label>
              <input type="number" min="1" class="form-control" id="cantidad_f" aria-describedby="dieselHelp"  value="" required="true" aria-required="true" name="cantidad_f">
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="guardar_so">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLong" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recibo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="card-img-top" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" rel="nofollow" alt="Card image cap" id="img_mos">
      </div>

    </div>
  </div>
</div>

@endsection

@push('js')
  <script>
    function imagen_mostrar(img){
      $("#img_mos").attr("src",img);
    }

    function cargar_id(id,order,estacion,cantidad){
      $("#input-estacion_id").val(id);
      $("#input-id_order").val(order);
      $("#input-estacion").val(estacion);
      $("#input-cantidad").val(cantidad);
    }

    function cargar_data_pedidos(id,cantidad){
      $("#id_order").val(id);
      $("#cantidad").val(cantidad);

    }

    function cargar_data_factura(id,cantidad){
      $("#id_f").val(id);
      $("#cantidad_f").val(cantidad);

    }

    $(".text-success").click(function() {

      $('#exampleModal').modal('toggle');

      $('#exampleModal').on('hidden.bs.modal', function (e) {
        
      })
    });

    $(".text-info").click(function() {

      $('#exampleModal2').modal('toggle');

      $('#exampleModal2').on('hidden.bs.modal', function (e) {
        
      })
    });

    $(".facturas_diferentes").click(function() {

      $('#exampleModal3').modal('toggle');

      $('#exampleModal3').on('hidden.bs.modal', function (e) {
        
      })
    });

  </script>
@endpush
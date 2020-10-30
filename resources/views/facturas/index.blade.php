@extends('layouts.app', ['page' => __('Gestion de las Facturas'), 'pageSlug' => __('Facturas')])

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
        <div class="card bg-blue">
          <div class="card-header card-header-primary">
            <h4 class="card-title text-white">{{ __('Facturas de Pedidos') }}</h4>
            <p class="card-category text-white mb-3"> {{ __('Aquí puedes administrar todas las facturas.') }}</p>
          </div>
        </div>
				<div class="card">
          <div class="card-body">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#link3" data-toggle="tab">Facturas Pendientes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#link4" data-toggle="tab">Facturas Concluidas</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tab-content tab-space">
              <div class="tab-pane active" id="link3" aria-expanded="true">
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                    <thead class=" text-primary">
                      <th>{{ __('# Factura') }}</th>
                      <th>{{ __('Sucursal') }}</th>
                      <th>{{ __('Producto') }}</th>
                      <th>{{ __('Litros') }}</th>
                      <th>{{ __('Costo') }}</th>
                      <th>{{ __('Costo Cubierto') }}</th>
                      <th>{{ __('Vencimiento') }}</th>
                      <th>{{ __('PDF') }}</th>
                      <th>{{ __('XML') }}</th>
                      @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                      <th class="text-center th-actions">{{ __('Acciones') }}</th>
                      @endif
                    </thead>
                    <tbody>
                      @foreach($orders as $order)
                      @if($order->orderpayment->where('id_status', 2)->sum('cantidad') < $order->costo_real)
                        <tr>
                          <td>{{ $order->id }}</td>
                          <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                          <td>{{ $order->producto }}</td>
                          <td>{{ number_format($order->cantidad_lts_final, 0) }}L</td>
                          <td>${{ number_format($order->costo_real, 2) }}</td>
                          <td class="text-center">
                              ${{ number_format($order->orderpayment->where('id_status', 2)->sum('cantidad'), 2) }}
                          </td>
                          <td>{{ $order->fecha_expiracion }}</td>
                          <td>
                            @if($order->pdf != "")
                            <a class="" href="{{url('storage/facturas_pdf/'.$order->estacion_id.'/'.$order->pdf ) }}" download="{{ $order->pdf }}">
                              <i class="material-icons-outlined text-info">picture_as_pdf</i>
                            </a>
                            @endif
                          </td>
                          <td>
                            @if($order->pdf != "")
                            <a href="{{url('storage/facturas_xml/'.$order->estacion_id.'/'.$order->xml ) }}" download="{{ $order->xml }}">
                              <i class="material-icons-outlined text-info">insert_drive_file</i>
                            </a>
                            @endif
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('pedidos.destroy', $order->id) }}" method="post">
                              @csrf
                              @method('delete')
                              @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                              <a class="btn btn-social btn-just-icon btn-link factura" title="" data-original-title="" rel="tooltip" onclick="order_id('{{ $order->id }}','{{ $order->estacion_id }}');">
                                <i class="tim-icons icon-attach-87"></i>
                              </a>
                              @endif
                              @if($order->orderpayment->where('id_status', 2)->sum('cantidad') < $order->costo_real)
                              <a class="btn btn-success btn-link factura_pedidos" href="#" rel="tooltip" title=" Abonar a esta factura." onclick="data_order({{$order->id}}, {{$order->costo_real - $order->orderpayment->where('id_status', 2)->sum('cantidad') }})">
                                <i class="tim-icons icon-money-coins"></i>
                              </a>
                              @endif
                              @if($order->orderpayment->where('id_status', 1)->sum('cantidad') > 0 || $order->orderpayment->where('id_status', 2)->sum('cantidad') > 0)
                              <a class="btn btn-blue btn-link pl-0 mt-0 pb-0" href="{{ route('facturas.show', $order->id) }}" rel="tooltip" title="Ver el historial de abonos a esta factura.">
                                <i class="material-icons-outlined p-0 m-0">
                                remove_red_eye
                                </i>
                              </a>
                              @endif
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
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_4">
                    <thead class=" text-primary">
                      <th>{{ __('# Factura') }}</th>
                      <th>{{ __('Sucursal') }}</th>
                      <th>{{ __('Producto') }}</th>
                      <th>{{ __('Litros') }}</th>
                      <th>{{ __('Costo') }}</th>
                      <th>{{ __('Costo Cubierto') }}</th>
                      <th>{{ __('Vencimiento') }}</th>
                      <th>{{ __('PDF') }}</th>
                      <th>{{ __('XML') }}</th>
                      
                      <th class="text-center th-actions">{{ __('Acciones') }}</th>
                      
                    </thead>
                    <tbody>
                      @foreach($orders as $order)
                      @if($order->orderpayment->where('id_status', 2)->sum('cantidad') == $order->costo_real)
                        <tr>
                          <td>{{ $order->id }}</td>
                          <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                          <td>{{ $order->producto }}</td>
                          <td>{{ number_format($order->cantidad_lts_final, 0) }}L</td>
                          <td>${{ number_format($order->costo_real, 2) }}</td>
                          <td class="text-center">
                              ${{ number_format($order->orderpayment->where('id_status', 2)->sum('cantidad'), 2) }}
                          </td>
                          <td>{{ $order->fecha_expiracion }}</td>
                          <td>
                            @if($order->pdf != "")
                            <a class="" href="{{url('storage/facturas_pdf/'.$order->estacion_id.'/'.$order->pdf ) }}" download="{{ $order->pdf }}">
                              <i class="material-icons-outlined text-info">picture_as_pdf</i>
                            </a>
                            @endif
                          </td>
                          <td>
                            @if($order->pdf != "")
                            <a href="{{url('storage/facturas_xml/'.$order->estacion_id.'/'.$order->xml ) }}" download="{{ $order->xml }}">
                              <i class="material-icons-outlined text-info">insert_drive_file</i>
                            </a>
                            @endif
                          </td>
                          
                          <td class="td-actions text-right">
                            <form action="{{ route('pedidos.destroy', $order->id) }}" method="post">
                              @csrf
                              @method('delete')         
                              <a class="btn btn-blue btn-link pl-0 mt-0 pb-0" href="{{ route('facturas.show', $order->id) }}" rel="tooltip" title="Ver el historial de abonos a esta factura.">
                                <i class="material-icons-outlined p-0 m-0">remove_red_eye</i>
                              </a>
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

    <!------------------->

    <div class="row justify-content-center">
      <div class="col-md-12 col-sm-12">
        <div class="card bg-blue">
          <div class="card-header card-header-primary">
            <h4 class="card-title text-white">
              {{ __('Facturas Diversas') }}
            </h4>
            <p class="card-category text-white mb-3">
              {{ __('Aquí puedes administrar todas las facturas atrasadas.') }}
            </p>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#link1" data-toggle="tab">Facturas Pendientes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#link2" data-toggle="tab">Facturas Concluidas</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                @if(auth()->user()->roles[0]->id == 1)
                <a class="btn btn-sm btn-primary" href="{{ route('facturas_diferentes.create') }}">
                  {{ __('Agregar factura') }}
                </a>
                @endif
              </div>
            </div>
            <div class="tab-content tab-space">
              <div class="tab-pane active" id="link1" aria-expanded="true">
                <div class="material-datatables">
                  <table cellspacing="0" class="table  table-hover"
                      id="datatables_2" style="width:100%" width="100%">
                    <thead class="text-primary">
                      @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                      <th>{{ __('Estacion')}}</th>
                      @endif
                      <th>{{ __('Descripcion')}}</th>
                      <th>{{ __('Costo')}}</th>
                      <th>{{ __('Costo cubierto') }}</th>
                      <th>{{ __('PDF')}}</th>
                      <th>{{ __('XML')}}</th>
                      <th>{{ __('Fecha de registro')}}</th>
                      @if(auth()->user()->roles[0]->id == 1)
                      <th class="disabled-sorting text-right">Acciones</th>
                      @endif
                    </thead>
                    <tbody>
                      @foreach($facturas as $factura)
                      @if( $factura->id_status == 1)
                      <tr>
                        <td>
                          {{ $factura->estacions[0]->nombre_sucursal}}
                        </td>
                        <td>
                          {{ $factura->description }}
                        </td>
                        <td class="text-center">
                          ${{ number_format($factura->quantity, 2) }}
                        </td>
                        <td class="text-center">
                          ${{ number_format($factura->differentbills->where('id_status', 2)->sum('cantidad'), 2) }}
                        </td>
                        <td>
                          <a class="" href="{{url('storage/facturas_pdf_2/'.$factura->id_estacion.'/'.$factura->file_pdf ) }}" download="{{ $factura->file_pdf }}">
                            <i class="material-icons-outlined text-info">picture_as_pdf</i>
                          </a>
                        </td>
                        <td>
                          <a href="{{url('storage/facturas_xml_2/'.$factura->id_estacion.'/'.$factura->file_xml ) }}" download="{{ $factura->file_xml }}">
                            <i class="material-icons-outlined text-info">insert_drive_file</i>
                          </a>
                        </td>
                        <td class="text-center">
                          {{ $factura->created_at->format('d/m/Y')  }}
                        </td>
                        @if(auth()->user()->roles[0]->id == 1)
                        <td class="td-actions text-right">
                          <form action="{{ route('facturas_diferentes.destroy', $factura->id) }}" method="post">
                            @csrf
                            @method('delete')
                            @if($factura->differentbills->where('id_status', 2)->sum('cantidad') < $factura->quantity)
                            <a class="btn btn-success btn-link abonar" data-original-title="Abonar a esta factura."
                              href="#" rel="tooltip"
                              title=" Abonar a esta factura." onclick="data_factura({{$factura->id_estacion}}, {{$factura->id}}, {{$factura->quantity - $factura->differentbills->where('id_status', 2)->sum('cantidad') }});">
                              <i class="tim-icons icon-money-coins"></i>
                            </a>
                            @endif
                            @if($factura->differentbills->where('id_status', 1)->sum('cantidad') > 0 || $factura->differentbills->where('id_status', 2)->sum('cantidad') > 0)
                            <a href="{{ route('facturas_diferentes.show', $factura->id) }}" class="btn btn-blue btn-link pl-0 mt-0 pb-0" data-original-title="Historial de abonos."
                              rel="tooltip"
                              title="Ver el historial de abonos a esta factura.">
                              <i class="material-icons-outlined p-0 m-0">
                              remove_red_eye
                              </i>
                            </a>
                            @endif
                            @if($factura->differentbills->where('id_status', 2)->sum('cantidad') == 0)
                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar esta factura." onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar esta factura?") }}') ? this.parentElement.submit() : ''">
                              <i class="tim-icons icon-trash-simple"></i>
                            </button>
                            @endif
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
                  <table cellspacing="0" class="table  table-hover"
                      id="datatables_3" style="width:100%" width="100%">
                    <thead class="text-primary">
                      @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                      <th>{{ __('Estación')}}</th>
                      @endif
                      <th>{{ __('Descripción')}}</th>
                      <th>{{ __('Costo')}}</th>
                      <th>{{ __('PDF')}}</th>
                      <th>{{ __('XML')}}</th>
                      <th>{{ __('Fecha del último pago')}}</th>
                      @if(auth()->user()->roles[0]->id == 1)
                      <th class="disabled-sorting text-right">Acciones</th>
                      @endif
                    </thead>
                    <tbody>
                      @foreach($facturas as $factura)
                      @if($factura->id_status == 2)
                      <tr>
                        <td>
                          {{ $factura->estacions[0]->nombre_sucursal}}
                        </td>
                        <td>
                          {{ $factura->description }}
                        </td>
                        <td class="text-center">
                          ${{ number_format($factura->quantity, 2) }}
                        </td>
                        <td>
                          <a class="" href="{{url('storage/facturas_pdf_2/'.$factura->id_estacion.'/'.$factura->file_pdf ) }}" download="{{ $factura->file_pdf }}">
                            <i class="material-icons-outlined text-info">picture_as_pdf</i>
                          </a>
                        </td>
                        <td>
                          <a href="{{url('storage/facturas_xml_2/'.$factura->id_estacion.'/'.$factura->file_xml ) }}" download="{{ $factura->file_xml }}">
                            <i class="material-icons-outlined text-info">insert_drive_file</i>
                          </a>
                        </td>
                        <td>
                          {{ $factura->differentbills[count($factura->differentbills)-1]->created_at->format('d/m/Y')  }}
                        </td>
                        <td class="td-actions text-right">
                          <a class="btn btn-blue btn-link pl-0 mt-0 pb-0" data-original-title="Abonar a esta factura."
                            href="{{ route('facturas_diferentes.show', $factura->id) }}" rel="tooltip"
                            title="Ver el historial de abonos a esta factura.">
                            <i class="material-icons-outlined p-0 m-0">
                            remove_red_eye
                            </i>
                          </a>
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

    <!--Modal 1 agregar pdf y xml-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ route('facturas.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
          @csrf
          @method('post')
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Factura y XML</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="estacion_id" id="estacion_id">
              <input type="hidden" name="order_id" id="order_id">
              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" multiple="" accept="application/pdf" class="inputFileHidden" name="pdf" id="input-pdf">
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Selecciona un PDF">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-fab btn-round btn-primary">
                        <i class="material-icons">attach_file</i>
                      </button>
                    </span>
                </div>
              </div>
              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" multiple="" accept="application/xml" class="inputFileHidden" name="xml" id="input-xml">
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Selecciona un XML">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-fab btn-round btn-primary">
                        <i class="material-icons">attach_file</i>
                      </button>
                    </span>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <input type="number" class="form-control" placeholder="Costo final" name="costo_real">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <input type="number" class="form-control" placeholder="Litros finales" name="litros_final">
                  </div>
                </div>
            
                <div class="col-sm-4">
                  <div class="form-group">
                    <input type="text" class="form-control datetimepicker bg-white" id="input-dia_entrega" name="fecha_expiracion"/>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary ml-2">
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal 2 solicitar abono facturas diversas-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ route('facturas_diferentes.pay') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
          @csrf
          @method('post')
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Abonar a la factura.</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <div class="row">
                <input type="hidden" class="form-control" id="id_estacion" name="id_estacion">
                <input type="hidden" class="form-control" id="id_different_bill" name="id_different_bill">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="number" class="form-control mt-1" placeholder="Cantidad" id="cantidad" name="cantidad" min="0">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <span class="btn btn-outline-secondary btn-file">
                        <span class="fileinput-new">Seleccionar Imagen</span>
                        <span class="fileinput-exists">Cambiar</span>
                        <input type="file" id="url" name="url" accept="image/png, image/jpeg"></input>
                      </span>
                      <span class="fileinput-filename"></span>
                      <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary ml-2" value="Solicitar" id="btn_submit_pay" disabled>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal 3 solicitar abono facturas pedidos-->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ route('pagos_pedidos.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
          @csrf
          @method('post')
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Abonar a la factura de este pedido.</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <div class="row">
                <input type="hidden" class="form-control" id="id_order" name="id_order">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="number" class="form-control mt-1" placeholder="Cantidad" id="cantidad_order" name="cantidad_order" min="0">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <span class="btn btn-outline-secondary btn-file">
                        <span class="fileinput-new">Seleccionar Imagen</span>
                        <span class="fileinput-exists">Cambiar</span>
                        <input type="file" id="url_order" name="url_order" accept="image/png, image/jpeg"></input>
                      </span>
                      <span class="fileinput-filename"></span>
                      <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary ml-2" value="Solicitar" id="btn_submit_order" disabled>
            </div>
          </form>
        </div>
      </div>
    </div>

	</div>
</div>


    
 
@endsection

@push('js')
  <script>
    function order_id(id,estacion){
      $("#estacion_id").val(estacion);
      $("#order_id").val(id);
    }

    function data_factura(id_estacion, id_different_bill, limite_abono){
      $("#id_different_bill").val(id_different_bill);
      $("#id_estacion").val(id_estacion);
      $("#cantidad").prop('max', limite_abono);
    }

    function data_order(id_order, limite_abono){
      $("#id_order").val(id_order);
      $("#cantidad_order").prop('max', limite_abono);
    }

    $(".factura").click(function() {
      $('#exampleModal').modal('toggle');
      $('#exampleModal').on('hidden.bs.modal', function (e) {
      })
    });

    
    $(".abonar").click(function() {
      $('#exampleModal2').modal('toggle');
      $('#exampleModal2').on('hidden.bs.modal', function (e) {
        $("#cantidad").val('');
        $("#btn_submit_pay").prop('disabled', true);
        $( "#url" ).val('')
      })
    });

    $(".factura_pedidos").click(function() {
      $('#exampleModal3').modal('toggle');
      $('#exampleModal3').on('hidden.bs.modal', function (e) {
        $("#cantidad_order").val('');
        $("#btn_submit_order").prop('disabled', true);
        $( "#url_order" ).val('')
      })
    });


    $("#url").change(function() {
        if($( "#url" ).val() != "" && $( "#cantidad" ).val() > 0){
            $("#btn_submit_pay").prop('disabled', false);
        } else {
            $("#btn_submit_pay").prop('disabled', true);
        }
    });

    $("#cantidad").change(function() {
        if($( "#url" ).val() != "" && $( "#cantidad" ).val() > 0){
            $("#btn_submit_pay").prop('disabled', false);
        } else {
            $("#btn_submit_pay").prop('disabled', true);
        }
    });

    $("#url_order").change(function() {
        if($( "#url_order" ).val() != "" && $( "#cantidad_order" ).val() > 0){
            $("#btn_submit_order").prop('disabled', false);
        } else {
            $("#btn_submit_ordder").prop('disabled', true);
        }
    });

    $("#cantidad_order").change(function() {
        if($( "#url_order" ).val() != "" && $( "#cantidad_order" ).val() > 0){
            $("#btn_submit_order").prop('disabled', false);
        } else {
            $("#btn_submit_order").prop('disabled', true);
        }
    });


    $(document).ready(function() {
      init_calendar('input-dia_entrega','01-01-2020', '07-07-2025');
    });


  </script>
@endpush

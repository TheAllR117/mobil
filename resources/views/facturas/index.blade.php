@extends('layouts.app', ['page' => __('Gestión de las Facturas'), 'pageSlug' => __('Facturas')])

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
        <div class="card bg-danger">
          <div class="card-header card-header-primary">
            <h4 class="card-title text-white">{{ __('Facturas') }}</h4>
            <p class="card-category text-white"> {{ __('Aquí puedes administrar todas las facturas.') }}</p>
          </div>
        </div>
				<div class="card">
          <div class="card-body">

            <div class="table-responsive">
              <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                <thead class=" text-primary">
                  <th>{{ __('SO Number') }}</th>
                  <th>{{ __('Estación') }}</th>
                  <th>{{ __('Nombre de la sucursal') }}</th>
                  <th>{{ __('Producto') }}</th>
                  <th>{{ __('Cantidad LTS.') }}</th>
                  <th>{{ __('Costo Aprox') }}</th>
                  <th>{{ __('Fecha de entrega') }}</th>
                  <th>{{ __('PDF') }}</th>
                  <th>{{ __('XML') }}</th>
                  @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                  <th class="text-center th-actions">{{ __('Acciones') }}</th>
                  @endif
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $order->so_number }}</td>
                      <td>{{ $order->estacions[0]->razon_social }}</td>
                      <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                      <td>{{ $order->producto }}</td>
                      <td>{{ number_format($order->cantidad_lts, 0) }}L</td>
                      <td>${{ number_format($order->costo_aprox, 2) }}</td>
                      <td>{{ $order->dia_entrega }}</td>
                      <td>
                        @if($order->pdf != "")
                          <a class="" href="{{url('storage/facturas_pdf/'.$order->estacion_id.'/'.$order->pdf ) }}" download="{{ $order->pdf }}">
                            <i class="material-icons btn-danger">picture_as_pdf</i>
                          </a>
                        @endif
                      </td>
                      <td>
                        @if($order->pdf != "")
                          <a href="{{url('storage/facturas_xml/'.$order->estacion_id.'/'.$order->xml ) }}" download="{{ $order->xml }}">
                            <i class="material-icons btn-danger">insert_drive_file</i>
                          </a>
                        @endif
                      </td>
                      @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3 || auth()->user()->roles[0]->id == 4)
                      <td class="td-actions">
                        <form action="{{ route('pedidos.destroy', $order->id) }}" method="post">
                          @csrf
                          @method('delete')

                          <a class="btn btn-social btn-just-icon btn-link factura" title="" data-original-title="" rel="tooltip" onclick="order_id('{{ $order->id }}','{{ $order->estacion_id }}');">
                            <i class="material-icons">attach_file</i>
                            <div class="ripple-container">
                            </div>
                          </a>

                        </form>
                      </td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
                    <!-- Modal -->
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

	              </div>
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

    $(".factura").click(function() {
      $('#exampleModal').modal('toggle');

      $('#exampleModal').on('hidden.bs.modal', function (e) {
      })
    });

    $(document).ready(function() {
      init_calendar('input-dia_entrega','01-01-2020', '07-07-2025');
    });


  </script>
@endpush

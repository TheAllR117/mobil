@extends('layouts.app', ['page' => __('Control'), 'pageSlug' => __('Control pedidos')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card bg-blue">
              <div class="card-header card-header-primary">
                <h4 class="card-title text-white">{{ __('Cotrol de pedidos') }}</h4>
                <p class="card-category text-white mb-3"> {{ __('') }}</p>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                    <thead class=" text-primary">
                      <th>
                        {{ __('Fecha de Carga') }}
                      </th>

                      <th>
                        {{ __('FLETERA') }}
                      </th>
                      <th>
                        {{ __('No de Equipo') }}
                      </th>
                      <th>
                        {{ __('No de tractor') }}
                      </th>
                      <th>
                        {{ __('No de placas') }}
                      </th>
                      <th>
                        {{ __('Nombre del operador') }}
                      </th>
                      <th>
                        {{ __('No de orden de carga') }}
                      </th>
                      <th>
                        {{ __('Producto a Cargar') }}
                      </th>
                      <th>
                        {{ __('Cantidad') }}
                      </th>
                      <th>
                        {{ __('Estación') }}
                      </th>
                      <th>
                        {{ __('PO Cliente') }}
                      </th>
                      <th>
                        {{ __('FACTURA A') }}
                      </th>
                      <th>
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($orders as $order)
                        <tr>
                          <td>{{ date("d/m/Y", strtotime($order->dia_entrega)) }}</td>
                          <td>
                            @if($order->controls[0]->freights[0]->namefreights == '[]')
                              {{ $order->controls[0]->freights[0]->estacions[0]->nombre_sucursal }}
                            @else
                              {{ $order->controls[0]->freights[0]->namefreights[0]->name  }}
                            @endif
                          </td>
                          <td>{{ $order->controls[0]->freights[0]->tractors[0]->pipes[0]->numero_economico }}</td>
                          <td>{{ $order->controls[0]->freights[0]->Tractors[0]->tractor }}</td>
                          <td>{{ $order->controls[0]->freights[0]->Tractors[0]->placas }}</td>
                          <td>{{ $order->controls[0]->driver->name }}</td>
                          <td>{{ $order->controls[0]->orders[0]->so_number }}</td>
                          <td>{{ $order->producto }}</td>
                          <td>{{ $order->cantidad_lts }}</td>
                          <td>{{ $order->estacions[0]->nombre_sucursal }}</td>
                          <td>{{ $order->po }}</td>
                          <td>{{ $order->factura_a }}</td>
                          <td>
                            <a class="btn btn-just-icon btn-link sonomber" title="Asignar Factura A" data-original-title="" rel="tooltip" id="precio" onclick="so_number('{{ $order->id }}','{{ $order->estacions[0]->nombre_sucursal }}');" >
                              <i class="material-icons text-primary">add_circle_outline</i>
                            </a>
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
              <label for="estacion_id">{{ __('ID Pedido') }}</label>
              <input type="text" class="form-control" id="input-estacion_id" aria-describedby="estacion_idHelp"  value="" required="true" aria-required="true" name="estacion_id">
            </div>
            <div class="form-group  col-sm-4">
              <label for="supreme">{{ __('Estaci贸n') }}</label>
              <input type="text" class="form-control" id="input-estacion" aria-describedby="supremeHelp"  value="" required="true" aria-required="true" name="estacion">
            </div>
            <div class="form-group  col-sm-4">
              <label for="diesel">{{ __('Factura A') }}</label>
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

@endsection

@push('js')
<script>
  $('#guardar_so').click(function(){
    $.ajax({
      url: 'control/factura/'+$("#input-estacion_id").val(),
      type: 'get',
      dataType: 'json',
      data: {
        '_token': $('input[name=_token]').val(),
        'id' : $("#input-estacion_id").val(),
        'factura_a': $("#input-so_number").val(),
      },
      headers:{ 
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
      },
      success: function(response){
        $('#exampleModal').modal('toggle');
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
</script>
@endpush
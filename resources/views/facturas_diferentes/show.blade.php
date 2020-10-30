@extends('layouts.app', ['page' => __('Gestión de Estaciones'), 'pageSlug' => __('Facturas')])

@section('content')
<div class="row">
  <div class="col-lg-8 col-md-6">
    <div class="card card-chart card-tasks">
        <div class="card-header ">
            <div class="row">
                <div class="col-sm-12 text-left">
                    <h3 class="card-title text-info">
                      <a href="{{ URL::previous()}}" title="Regresar atras">
                        <i class="tim-icons icon-minimal-left text-info"></i>
                      </a>
                      Historial de pagos realizados.
                    </h3>
                </div>
            </div>
        </div>
        <div class="card-body mt-4">
            <div class="table-full-width table-responsive ps">
                <table class="table tablesorter " id="simple-table">
                    <thead class=" text-primary">
                        <tr>
                            <th class="header headerSortUp">#</th>
                            <th class="header headerSortUp">Status</th>
                            <th class="header">Combrobate</th>
                            <th class="header">Fecha de solicitud</th>
                            <th class="text-center header">Cantidad abonada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facturas as $key => $factura)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $factura->status[0]->name }}</td>
                            <td><img  src="{{ url('storage/bill_payment/'.$estacion->id_estacion.'/'.$factura->url) }}"  style="width: 40px;" data-toggle="modal" data-target="#exampleModalLong" title="click para ampliar." onclick="imagen_mostrar('{{ url('storage/bill_payment/'.$estacion->id_estacion.'/'.$factura->url) }}');"/></td>
                            <td>{{ $factura->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">${{ number_format($factura->cantidad, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Total:</strong></td>
                            <td class="text-center header"><strong>${{ number_format($facturas->where('id_status', 2)->sum('cantidad'), 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6">
    <div class="card card-tasks">
        <div class="card-header text-center">
          <h3 class="title d-inline text-info">{{ $estacion->description }}</h3><br>
        </div>
        <div class="card-body">
          
              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3 ">request_page</i>
                  </div>
                </div>
                <div class="col-8 col-sm-8">
                  <strong class="text-dark">Cantidad a Pagar</strong><br>
                  ${{ number_format($estacion->quantity, 2) }}
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3">payments</i>
                  </div>
                </div>
                <div class="col-8 col-sm-8">
                  <strong class="text-dark">Cantidad Cubierta</strong><br>
                  ${{ number_format($facturas->where('id_status', 2)->sum('cantidad'), 2) }}
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3">attach_money</i>
                  </div>
                </div>
                <div class="col-8 col-sm-8">
                  <strong class="text-dark">Falta por Cubrir</strong><br>
                  ${{ number_format($estacion->quantity - $facturas->where('id_status', 2)->sum('cantidad'), 2) }}
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-3 col-sm-3 text-center">
                  <div class="card bg-warning">
                    <i class="material-icons text-danger pt-3 pb-3">published_with_changes</i>
                  </div>
                </div>
                <div class="col-8 col-sm-8">
                  <strong class="text-dark">Pagos Pendientes por Autorizar</strong><br> 
                  {{ $facturas->where('id_status', 1)->count() }}
                </div>
              </div>
          
        </div>
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
    </script>
@endpush
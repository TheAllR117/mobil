@extends('layouts.app', ['page' => __('Gestión de los abonos'), 'pageSlug' => __('Abonos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Abonos') }}</h4>
                <p class="card-category"> {{ __('Aquí puedes administrar todos los abonos.') }}</p>
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
                       <a href="{{ route('abonos.create') }}" class="btn btn-sm btn-primary">{{ __('Hacer Abono') }}</a>
                    </div>
                </div>
                
                <ul class="nav nav-pills nav-pills-primary mb-4" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist" aria-expanded="true">
                      Abonos Pendientes
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#link2" role="tablist" aria-expanded="false">
                      Abonos Autorizados
                    </a>
                  </li>
                </ul>

                <div class="tab-content tab-space">
                  <div class="tab-pane active" id="link1" aria-expanded="true">
                    <div class="row">

                      <div class="table-responsive">
                        <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
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

                                      <a class="btn btn-twitter btn-link" title="Validar Abono" data-original-title="" rel="tooltip" id="precio" onclick="cargar_id('{{ $payment->id_estacion }}','{{ $payment->id }}','{{ $payment->estacions[0]->nombre_sucursal }}','{{$payment->cantidad}}');">
                                        <i class="tim-icons icon-check-2"></i>
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
                  </div>
                  <div class="tab-pane" id="link2" aria-expanded="false">
                    <div class="row">

                      <div class="table-responsive">
                        <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_2">
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
                              @if($payment->statu_orders->id == 2 )
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

              	</div>
          	</div>
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

    $('#guardar_so').click(function(){
      $.ajax({
        url: 'abonos/sal_o_cre',
        type: 'POST',
        dataType: 'json',
        data: {
          '_token': $('input[name=_token]').val(),
          'id_estacion' : $("#input-estacion_id").val(),
          'cantidad' : $("#input-cantidad").val(),
          'id': $("#input-id_order").val(),
        },
        headers:{ 
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response){
          $('#exampleModal').modal('toggle');
          alert(response);
          location.reload(true);
        }
      });
    });

    $(".btn-twitter").click(function() {

      $('#exampleModal').modal('toggle');

      $('#exampleModal').on('hidden.bs.modal', function (e) {
        
      })
    });

  </script>
@endpush
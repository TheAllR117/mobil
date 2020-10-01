@extends('layouts.app', ['page' => __('Control'), 'pageSlug' => __('Control pedidos')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Cotrol de pedidos') }}</h4>
                <p class="card-category"> {{ __('.') }}</p>
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
                    </thead>
                    <tbody>
                      @foreach($orders as $order)
                        <tr>
                          <td>{{ $order->dia_entrega }}</td>
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
                          <td></td>     
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
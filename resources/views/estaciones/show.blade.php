@extends('layouts.app', ['page' => __('Gestión de Estaciones'), 'pageSlug' => __('Estaciones')])

@section('content')

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">
          <a href="{{ route('estaciones.index') }}" title="Regresar a la lista">
              <i class="tim-icons icon-minimal-left text-danger"></i>
          </a>
          {{ __($estacion->razon_social) }}
        </h4>
        <p class="card-category">
          <b><strong>RFC: </strong></b>{{ $estacion->rfc }}
          <b class="ml-3"><strong> CRE: </strong></b>{{ $estacion->cre }}
          <b class="ml-3"><strong>SH: </strong></b>{{ $estacion->sh }}
          <b class="ml-3"><strong>Crédito: </strong></b>${{ number_format($estacion->credito,2) }}
          <b class="ml-3"><strong>Crédito utilizado: </strong></b>${{ number_format($estacion->credito_usado,2) }}
          <b class="ml-3"><strong>Saldo: </strong></b>${{ number_format($estacion->saldo,2) }}
        </p>
      </div>
      
    </div>
  </div>
</div>
  

<div class="row">
  <div class="col-lg-6 col-md-12">
      <div class="card card-tasks">
          <div class="card-header">
              <h4 class="card-title">Historial de precios de combustible</h4>
              <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#pablo">Action</a>
                      <a class="dropdown-item" href="#pablo">Another action</a>
                      <a class="dropdown-item" href="#pablo">Something else</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <div class="table-full-width table-responsive">
                <table cellspacing="0" class="table tablesorter" id="datatables_1" width="100%">
                  <thead class="text-primary">
                    <th class="mr-5 ml-5">Extra</th>
                    <th>Supreme</th>
                    <th>Diesel</th>
                    <th>Fecha</th>
                  </thead>
                  <tbody>
                    @foreach($estacion->prices as $price)
                    <tr>
                      <td>{{ $price->extra }}</td>
                      <td>{{ $price->supreme }}</td>
                      <td>{{ $price->diesel }}</td>
                      <td>{{ $price->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>

  <div class="col-lg-6 col-md-12">
      <div class="card card-tasks">
          <div class="card-header">
              <h4 class="card-title">Historial de ordenes concluidas</h4>
              <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#pablo">Action</a>
                      <a class="dropdown-item" href="#pablo">Another action</a>
                      <a class="dropdown-item" href="#pablo">Something else</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <div class="table-full-width table-responsive">
                <table cellspacing="0" class="table" id="datatables_2" width="100%">
                  <thead class="text-primary">
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Costo Aprox</th>
                    <th>Fecha</th>
                  </thead>
                  <tbody>
                    @foreach($estacion->orders as $order)
                      @if($order->status_id == 5)
                        <tr>
                          <td>{{ $order->producto }}</td>
                          <td>{{ number_format($order->cantidad_lts,0) }}L</td>
                          <td>${{ number_format($order->costo_aprox, 2) }}</td>
                          <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
  
  <div class="col-lg-6 col-md-12">
    <div class="card ">
      <div class="card-header">
          <h4 class="card-title">Lista de usuarios</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            <table cellspacing="0" class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" id="datatables_3" width="100%">
              <thead class="text-primary">
                <th>Nombre</th>
                <th>Email</th>
                <th>Activo</th>
                <th>Fecha de Alta</th>
              </thead>
              <tbody>
                @foreach($estacion->users as $user)
                <tr>
                  <td>{{ $user->name }} {{ $user->app_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                  @if($estacion->linea_credito == 1)
                    Activo
                  @else
                    Inactivo
                  @endif
                  </td>
                  <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      iniciar_date('datatables');
      iniciar_date('datatables1');
      iniciar_date('datatables2');
    });
  </script>
@endpush

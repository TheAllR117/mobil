@extends('layouts.app', ['page' => __('Gestión de Fleteras'), 'pageSlug' => __('Fleteras')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Envíos realizados por fletes') }}</h4>
                <p class="card-category"> {{ __('Aquí puedes consultar los envíos realizados por las fleteras.') }}</p>
              </div>
              <div class="card-body">

                <div class="row mt-2 mb-2">

                    <div class="pl-3">
                        <form action="{{ route('consultaenvios.index') }}" method="GET">

                            <div class="d-flex">

                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de inicio:</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                </div>

                                <div class="form-group ml-4">
                                    <label for="fecha_termino">Fecha de termino:</label>
                                    <input type="date" class="form-control" id="fecha_termino" name="fecha_termino" required>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Consultar</button>
                        </form>

                    </div>

                </div>
                <div class="table-responsive">
                  <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                    <thead class=" text-primary">
                      <th>
                        {{ __('Fletera') }}
                      </th>
                      <th>
                        {{ __('Terminal') }}
                      </th>
                      <th>
                        {{ __('Conductor') }}
                      </th>
                      <th>
                        {{ __('Tractor') }}
                      </th>
                      <th>
                        {{ __('Fecha de entrega') }}
                      </th>
                    </thead>
                    <tbody id="tbody-envios">
                      @foreach ( $array_pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido['fletera'] }}</td>
                                <td>{{ $pedido['terminal'] }}</td>
                                <td>{{ $pedido['conductor'] }}</td>
                                <td>{{ $pedido['tractor'] }}</td>
                                <td>{{ $pedido['dia_entrega'] }}</td>
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


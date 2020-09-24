@extends('layouts.app', ['activePage' => 'Estaciones', 'titlePage' => __('Gestión de Estaciones')])

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 ">
            <div class="card">
              <div class="card-header card-header-primary">
                <div class="row">
                  <div class="col mt-3">
                    <h4 class="card-title ">{{ __('Estaciones') }}</h4>
                    <p class="card-category"> {{ __('Aquí puedes administrar todas las estaciones.') }}</p>
                  </div>
                  <div class="col mt-3">
                  <form action="{{ route('estaciones.import_excel') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group form-file-upload form-file-multiple">
                      <input type="file" multiple="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="inputFileHidden" name="select_file" id="input-pdf">

                      <div class="input-group">
                        <label>
                            Fecha
                            <input type="date" class="form-control form-control" style="color: #fff;"  name="fecha_precio_sugerido" required>
                        </label>
                      </div>

                      <div class="input-group">
                        <input type="text" class="form-control inputFileVisible text-light" placeholder="Selecciona un archivo Excel" id="archivo_excel">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-fab btn-round ">
                                <i class="material-icons">attach_file</i>
                            </button>
                        </span>
                        <button type="submit" id="archivo_excel_boton" class="btn btn-sm btn-danger" disabled>
                          Cargar
                        </button>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>

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
                    @if(auth()->user()->roles[0]->id == 1)
                    <a href="{{ route('estaciones.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar Estación') }}</a>
                    @endif
                  </div>
                </div>
                <div class="">
                    <table id="datatables" class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%">
                    <thead class="text-primary">
                      <th tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions: activate to sort column ascending">Nombre</th>
                      <th>CRE</th>
                      <th>RFC</th>
                      <th>Sucursal</th>
                      <th>Estatus</th>
                      <th>Crédito</th>
                      <th>Fecha de alta</th>
                      <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 86px;" aria-label="Actions: activate to sort column ascending">Acciones</th>
                    </thead>
                    <tbody>
                      @foreach($estaciones as $estacion)
                        <tr>
                          <td>{{ $estacion->razon_social }}</td>
                          <td>{{ $estacion->cre }}</td>
                          <td>{{ $estacion->rfc }}</td>
                          <td>{{ $estacion->nombre_sucursal }}</td>
                          <td>
                            @if($estacion->status == 1)
                              Activa
                            @else
                              Inactiva
                            @endif
                          </td>
                          <td>
                            @if($estacion->linea_credito == 1)
                              si
                            @else
                              no
                            @endif
                          </td>
                          <td>
                            {{ $estacion->created_at->format('d/m/Y') }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('estaciones.destroy', $estacion->id) }}" method="post">
                              @csrf
                              @method('delete')
                              @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                              <a class="btn btn-info btn-link" data-original-title=""
                                onclick="conseguir_valores({{$estacion->id}},{{$estacion->utilidad_r}},{{$estacion->utilidad_p}},{{$estacion->utilidad_d}});" rel="tooltip"
                                title="Agregar precio de mañana" id="precio">
                                <i class="material-icons">monetization_on</i>
                                <div class="ripple-container">
                                </div>
                              </a>
                              @endif
                              @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 2 )

                              <a class="btn btn-danger btn-link" data-original-title=""
                                href="{{ route('estaciones.show', $estacion) }}" rel="tooltip"
                                title="Ver información de la estación">
                                <i class="material-icons">visibility</i>
                                <div class="ripple-container">
                                </div>
                              </a><br>
                              @endif
                              @if(auth()->user()->roles[0]->id == 1 )
                              <a class="btn btn-success btn-link" data-original-title=""
                                href="{{ route('estaciones.edit', $estacion) }}" rel="tooltip"
                                title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container">
                                </div>
                              </a>
                              <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta Estación?") }}') ? this.parentElement.submit() : ''">
                                <i class="material-icons">delete</i>
                                <div class="ripple-container"></div>
                              </button>
                              @endif
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!--inputs para las operaciones-->
                <input type="hidden" id="id">
                <input type="hidden" id="utilidad_r">
                <input type="hidden" id="utilidad_p">
                <input type="hidden" id="utilidad_d">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Precios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <input type="hidden" name="id_estacion" id="input-id_estacion">
                          <div class="form-group  col-sm-4">
                            <label for="extra">{{ __('Precio Extra') }}</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="input-extra" aria-describedby="extraHelp"  value="" required="true" aria-required="true" name="extra">
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="supreme">{{ __('Precio Supreme') }}</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="input-supreme" aria-describedby="supremeHelp"  value="" required="true" aria-required="true" name="supreme">
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="diesel">{{ __('Precio Diesel') }}</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="input-diesel" aria-describedby="dieselHelp"  value="" required="true" aria-required="true" name="diesel">
                          </div>

                        </div>
                        <div class="row">

                          <div class="form-group  col-sm-4">
                            <label for="extra_1">{{ __('Extra con utilidad') }}</label>
                            <input type="text" class="form-control" id="input-extra_1" aria-describedby="extra_1Help"  value="0"  aria-required="true" name="extra_1" id="extra_1" disabled>
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="supreme_1">{{ __('Supreme con utilidad') }}</label>
                            <input type="text" class="form-control" id="input-supreme_1" aria-describedby="supreme_1Help"  value="0"  aria-required="true" name="supreme_1" id="supreme_1" disabled>
                          </div>
                          <div class="form-group  col-sm-4">
                            <label for="diesel_1">{{ __('Diesel con utilidad') }}</label>
                            <input type="text" class="form-control" id="input-diesel_1" aria-describedby="diesel_1Help"  value="0" aria-required="true" name="diesel_1" id="diesel_1" disabled>
                          </div>

                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="guardar_price">Guardar</button>
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

   $( "#archivo_excel" ).change(function() {
      if($( "#archivo_excel" ).val() != ""){
        $("#archivo_excel_boton").prop('disabled', false);
      } else {
        $("#archivo_excel_boton").prop('disabled', true);
      }
    });

    $(".btn-info").click(function() {
      //data-toggle="modal" data-target="#exampleModal"
      $('#exampleModal').modal('toggle');

      $('#exampleModal').on('hidden.bs.modal', function (e) {
        $("#input-extra").val('0');
        $("#input-supreme").val('0');
        $("#input-diesel").val('0');

        $("#input-extra_1").val('0');
        $("#input-supreme_1").val('0');
        $("#input-diesel_1").val('0');
      })
      //console.log('hola');
      suma_adictivo('input-extra','input-extra_1','utilidad_r');
      suma_adictivo('input-supreme','input-supreme_1','utilidad_p');
      suma_adictivo('input-diesel','input-diesel_1','utilidad_d');
    });


    $('#guardar_price').click(function(){
      $.ajax({
        url: 'precio/store',
        type: 'POST',
        dataType: 'json',
        data: {
          '_token': $('input[name=_token]').val(),
          'id_estacion' : $("#id").val(),
          'extra': $("#input-extra").val(),
          'supreme': $("#input-supreme").val(),
          'diesel': $("#input-diesel").val(),
          'extra_u': $("#input-extra_1").val(),
          'supreme_u': $("#input-supreme_1").val(),
          'diesel_u': $("#input-diesel_1").val(),
        },
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          $('#exampleModal').modal('toggle');
          alert(response);
        }
      });
    });

    $(document).ready(function() {

      iniciar_date('datatables');
      iniciar_selector_de_archivos();
      /*$('#datatables').DataTable({

        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'btn btn-sm btn-success pull-right',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Buscar...",
          processing:     "Transformación...",
          search:         "Buscar:",
          lengthMenu:     "Mostrar _MENU_ Resultados",
          info:           "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          infoEmpty:      "0 Entradas de 0 Disponibles",
          infoFiltered:   "(filtrado de entre _MAX_ elementos disponibles)",
          infoPostFix:    "",
          loadingRecords: "Cargando...",
          zeroRecords:    "No se encontraron elementos coincidentes.",
          emptyTable:     "No hay datos disponibles.",
          paginate: {
            first:      "<<",
            previous:   "<",
            next:       ">",
            last:       ">>"
          },
          aria: {
            sortAscending : "active para ordenar la columna en orden ascendente",
            sortDescending: "active para ordenar la columna en orden descendente"
          }
        }
      });

      /*var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
      $( "#datatables_filter").addClass( "text-right" );
      $( "#datatables_paginate").addClass( "text-right" );*/
    });


    /*$(document).ready(function() {
       $('#table_1').DataTable({
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
       });

    });*/
  </script>
@endpush

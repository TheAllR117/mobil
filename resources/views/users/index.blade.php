@extends('layouts.app', ['page' => __('Gestión de usuarios'), 'pageSlug' => __('Usuarios')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card bg-blue">
            <div class="card-header card-header-primary text-white">
              <h4 class="card-title text-white">{{ __('Usuarios') }}</h4>
              <p class="card-category text-white mb-3"> {{ __('Aquí puedes administrar a los usuarios.') }}</p>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 text-right">
                  @if(auth()->user()->roles[0]->id == 1)
                  <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar Usuario') }}</a>
                  @endif
                </div>
              </div>
              <div class="table-responsive">
                <table class="table dataTable table-sm table-striped table-no-bordered table-hover material-datatables" cellspacing="0" width="100%"  id="datatables_1">
                  <thead class=" text-primary">
                    <th>
                        {{ __('Nombre') }}
                    </th>
                    <th>
                      {{ __('Email') }}
                    </th>
                    <th>
                      {{ __('Teléfono') }}
                    </th>
                    <th>
                      {{ __('Rol') }}
                    </th>
                    <th>
                      {{ __('Estación') }}
                    </th>
                    <th>
                      {{ __('Fecha de Alta') }}
                    </th>
                    @if(auth()->user()->roles[0]->id == 1)
                      <th class="text-center th-actions">{{ __('Acciones') }}</th>

                    @endif
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>
                          {{ $user->name }} {{ $user->app_name }} {{ $user->apm_name }}
                        </td>
                        <td>
                          {{ $user->email }}
                        </td>
                        <td>
                          {{ $user->phone }}
                        </td>
                        <td>
                          @foreach( $user->roles as $rol)
                            {{ $rol->name }}
                          @endforeach
                        </td>
                        <td  width="5%">
                          <select id="input-razon_social" name="razon_social[]" class="selectpicker p-0 m-0 text-white" multiple data-style="btn-primary text-white">
                            @foreach( $user->estacions as $estacion)
                              @if($estacion->nombre_sucursal == '*')
                              <option selected disabled>Todas las Estaciones</option>
                              @else
                              <option selected disabled>{{ $estacion->nombre_sucursal }}</option>
                              @endif
                            @endforeach  
                          </select>
                        </td>
                        <td>
                          {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        @if(auth()->user()->roles[0]->id == 1)
                        <td class="td-actions text-right">
                          @if ($user->id != auth()->id())
                            <form action="{{ route('user.destroy', $user) }}" method="post">
                                @csrf
                                @method('delete')
                            
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.edit', $user) }}" data-original-title="" title="">
                                  <i class="tim-icons icon-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a este usuario?") }}') ? this.parentElement.submit() : ''">
                                  <i class="tim-icons icon-trash-simple"></i>
                                </button>
                            </form>
                          @else
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                              <i class="tim-icons icon-pencil"></i>
                            </a>
                          @endif
                        </td>
                        @endif
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

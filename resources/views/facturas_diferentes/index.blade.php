@extends('layouts.app', ['page' => __('Registrar facturas'), 'pageSlug' => __('Facturas diversas')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card bg-danger">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-white">
                            {{ __('Registrar facturas') }}
                        </h4>
                        <p class="card-category text-white">
                            {{ __('Aquí puedes administrar todas las facturas atrasadas.') }}
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                @if(auth()->user()->roles[0]->id == 1)
                                <a class="btn btn-sm btn-primary" href="{{ route('facturas_diferentes.create') }}">
                                    {{ __('Agregar factura') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="material-datatables">
                            <table cellspacing="0" class="table table-striped table-no-bordered table-hover"
                                id="datatables_1" style="width:100%" width="100%">
                                <thead class="text-primary">
                                    @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                                    <th>
                                        {{ __('Estación')}}
                                    </th>
                                    @endif
                                    <th>
                                        {{ __('Descripción')}}
                                    </th>
                                    @if(auth()->user()->roles[0]->id == 1 || auth()->user()->roles[0]->id == 3)
                                    <th>
                                        {{ __('Movimiento')}}
                                    </th>
                                    @endif
                                    <th>
                                        {{ __('Cantidad')}}
                                    </th>
                                    <th>
                                        {{ __('PDF')}}
                                    </th>
                                    <th>
                                        {{ __('XML')}}
                                    </th>
                                    <th>
                                        {{ __('Fecha de registro')}}
                                    </th>
                                    @if(auth()->user()->roles[0]->id == 1)
                                    <th class="disabled-sorting text-right">
                                        Acciones
                                    </th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach($facturas as $factura)
                                    <tr>
                                        <td>
                                            {{ $factura->estacions[0]->nombre_sucursal}}
                                        </td>
                                        <td>
                                            {{ $factura->description }}
                                        </td>
                                        <td>
                                            @if($factura->add_or_subtract == 1)
                                            Cobro
                                            @else
                                            Devolución
                                            @endif
                                        </td>
                                        <td>
                                            ${{ number_format($factura->quantity, 2) }}
                                        </td>
                                        <td>
                                            <a class="" href="{{url('storage/facturas_pdf_2/'.$factura->id_estacion.'/'.$factura->file_pdf ) }}" download="{{ $factura->file_pdf }}">
                                                <i class="material-icons text-danger">picture_as_pdf</i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('storage/facturas_xml_2/'.$factura->id_estacion.'/'.$factura->file_xml ) }}" download="{{ $factura->file_xml }}">
                                                <i class="material-icons text-danger">insert_drive_file</i>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $factura->created_at->format('d/m/Y')  }}
                                        </td>
                                        @if(auth()->user()->roles[0]->id == 1)
                                        <td class="td-actions text-right">
                                            <form action="{{ route('facturas_diferentes.destroy', $factura->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger btn-link"
                                                    data-original-title="" title=""
                                                    onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar esta factura?") }}') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-trash-simple"></i>
                                                </button>
                                            </form>
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

@extends('layouts.app', ['page' => __('Alta de Terminales'), 'pageSlug' => __('Terminales')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div class="card bg-blue">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-white">
                            {{ __('Terminales') }}
                        </h4>
                        <p class="card-category text-white mb-3">
                            {{ __('Aquí puedes administrar todas las terminales.') }}
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                @if(auth()->user()->roles[0]->id == 1)
                                <a class="btn btn-sm btn-primary" href="{{ route('terminales.create') }}">
                                    {{ __('Agregar Terminal') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="material-datatables">
                            <table cellspacing="0" class="table table-striped table-no-bordered table-hover"
                                id="datatables_1" style="width:100%" width="100%">
                                <thead class="text-primary">
                                    <th>
                                        {{ __('ID')}}
                                    </th>
                                    <th>
                                        {{ __('Nombre')}}
                                    </th>
                                    <th>
                                        {{ __('Clave')}}
                                    </th>
                                    <th>
                                        {{ __('Fecha de Alta')}}
                                    </th>
                                    @if(auth()->user()->roles[0]->id == 1)
                                    <th class="disabled-sorting text-right">
                                        Acciones
                                    </th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach($terminals as $terminal)
                                    <tr>
                                        <td>
                                            {{ $terminal->id }}
                                        </td>
                                        <td>
                                            {{ $terminal->razon_social }}
                                        </td>
                                        <td>
                                            {{ $terminal->codigo }}
                                        </td>
                                        <td>
                                            {{ $terminal->created_at->format('d/m/Y')  }}
                                        </td>
                                        @if(auth()->user()->roles[0]->id == 1)
                                        <td class="td-actions text-right">
                                            <form action="{{ route('terminales.destroy', $terminal->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-success btn-link" data-original-title=""
                                                    href="{{ route('terminales.edit', $terminal) }}" rel="tooltip"
                                                    title="">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                    data-original-title="" title=""
                                                    onclick="confirm('{{ __("¿Estás seguro de que deseas eliminar a esta Terminal?") }}') ? this.parentElement.submit() : ''">
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

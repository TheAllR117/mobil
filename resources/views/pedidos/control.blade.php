@extends('layouts.app', ['activePage' => 'Control pedidos', 'titlePage' => __('Gestión de los pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('pedidos.store') }}" autocomplete="off" class="form-horizontal" method="post">
                  @csrf
                  @method('post')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">
                                {{ __('Armar Envio') }}
                            </h4>
                            <p class="card-category">
                            </p>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app', ['page' => __('Gestión de Estaciones'), 'pageSlug' => __('Estaciones')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto d-block mt-3">
                <form action="{{ route('estaciones.update', $estacion_edit) }}" autocomplete="off" class="form-horizontal" method="post">
                    @csrf
                    @method('post')
                    <div class="card bg-blue">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-white">
                                <a href="{{ route('estaciones.index') }}" title="Regresar a la lista">
                                    <i class="tim-icons icon-minimal-left text-white"></i>
                                </a>
                                {{ __('Editar Estación') }}
                            </h4>
                            <p class="card-category">
                            </p>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-body">
                           
                            <div class="row mt-5">
                                <div class="form-group{{ $errors->has('razon_social') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="razon_social">
                                        {{ __('Razón social') }}
                                    </label>
                                    <input aria-describedby="razon_socialHelp" aria-required="true" class="form-control{{ $errors->has('razon_social') ? ' is-invalid' : '' }}" id="input-razon_social" name="razon_social" required="true" type="text" value="{{ old('razon_social', $estacion_edit->razon_social)}}">
                                        @if ($errors->has('razon_social'))
                                        <span class="error text-danger" for="input-razon_social" id="razon_social-error">
                                            {{ $errors->first('razon_social') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('rfc') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="rfc">
                                        {{ __('RFC') }}
                                    </label>
                                    <input aria-describedby="rfcHelp" aria-required="true" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" id="input-rfc" name="rfc" type="text" value="{{ old('rfc',$estacion_edit->rfc) }}">
                                        @if ($errors->has('rfc'))
                                        <span class="error text-danger" for="input-rfc" id="rfc-error">
                                            {{ $errors->first('rfc') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('cre') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="cre">
                                        {{ __('CRE') }}
                                    </label>
                                    <input aria-describedby="creHelp" aria-required="true" class="form-control{{ $errors->has('cre') ? ' is-invalid' : '' }}" id="input-cre" name="cre" type="text" value="{{ old('cre', $estacion_edit->cre) }}">
                                        @if ($errors->has('cre'))
                                        <span class="error text-danger" for="input-cre" id="cre-error">
                                            {{ $errors->first('cre') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group{{ $errors->has('sh') ? ' has-danger' : '' }} col-sm-6">
                                    <label for="sh">
                                        {{ __('SH') }}
                                    </label>
                                    <input aria-describedby="shHelp" aria-required="true" class="form-control{{ $errors->has('sh') ? ' is-invalid' : '' }}" id="input-sh" name="sh" type="text" value="{{ old('sh',$estacion_edit->sh) }}">
                                        @if ($errors->has('sh'))
                                        <span class="error text-danger" for="input-sh" id="sh-error">
                                            {{ $errors->first('sh') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('nombre_sucursal') ? ' has-danger' : '' }} col-sm-6">
                                    <label for="nombre_sucursal">
                                        {{ __('Nombre de la sucursal') }}
                                    </label>
                                    <input aria-describedby="nombre_sucursalHelp" aria-required="true" class="form-control{{ $errors->has('nombre_sucursal') ? ' is-invalid' : '' }}" id="input-nombre_sucursal" name="nombre_sucursal" type="text" value="{{ old('nombre_sucursal',$estacion_edit->nombre_sucursal) }}">
                                        @if ($errors->has('nombre_sucursal'))
                                        <span class="error text-danger" for="input-nombre_sucursal" id="nombre_sucursal-error">
                                            {{ $errors->first('nombre_sucursal') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group{{ $errors->has('flete_r') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="flete_r">
                                        {{ __('Flete R') }}
                                    </label>
                                    <input aria-describedby="flete_rHelp" aria-required="true" class="form-control{{ $errors->has('flete_r') ? ' is-invalid' : '' }}" id="input-flete_r"  min="0" name="flete_r"  step="0.0001" type="number" value="{{ old('flete_r', $estacion_edit->flete_r) }}">
                                        @if ($errors->has('flete_r'))
                                        <span class="error text-danger" for="input-flete_r" id="flete_r-error">
                                            {{ $errors->first('flete_r') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('flete_p') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="flete_p">
                                        {{ __('Flete P') }}
                                    </label>
                                    <input aria-describedby="flete_dHelp" aria-required="true" class="form-control{{ $errors->has('flete_p') ? ' is-invalid' : '' }}" id="input-flete_p" min="0" name="flete_p" step="0.0001" type="number" value="{{ old('flete_p', $estacion_edit->flete_p) }}">
                                        @if ($errors->has('flete_p'))
                                        <span class="error text-danger" for="input-flete_p" id="flete_p-error">
                                            {{ $errors->first('flete_p') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('flete_d') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="flete_d">
                                        {{ __('Flete D') }}
                                    </label>
                                    <input aria-describedby="flete_dHelp" aria-required="true" class="form-control{{ $errors->has('flete_d') ? ' is-invalid' : '' }}" id="input-flete_d" min="0" name="flete_d" step="0.0001"  type="number" value="{{ old('flete_d', $estacion_edit->flete_d) }}">
                                        @if ($errors->has('flete_d'))
                                        <span class="error text-danger" for="input-flete_d" id="flete_d-error">
                                            {{ $errors->first('flete_d') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group{{ $errors->has('ieps_r') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="ieps_r">
                                        {{ __('IEPS R') }}
                                    </label>
                                    <input aria-describedby="ieps_rHelp" aria-required="true" class="form-control{{ $errors->has('ieps_r') ? ' is-invalid' : '' }}" id="input-ieps_r"  min="0" name="ieps_r"  step="0.0001"  type="number" value="{{ old('ieps_r', $estacion_edit->ieps_r) }}">
                                        @if ($errors->has('ieps_r'))
                                        <span class="error text-danger" for="input-ieps_r" id="ieps_r-error">
                                            {{ $errors->first('ieps_r') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('ieps_p') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="ieps_p">
                                        {{ __('IEPS P') }}
                                    </label>
                                    <input aria-describedby="ieps_dHelp" aria-required="true" class="form-control{{ $errors->has('ieps_p') ? ' is-invalid' : '' }}" id="input-ieps_p"  min="0" name="ieps_p" step="0.0001"  type="number" value="{{ old('ieps_p', $estacion_edit->ieps_p) }}">
                                        @if ($errors->has('ieps_p'))
                                        <span class="error text-danger" for="input-ieps_p" id="ieps_p-error">
                                            {{ $errors->first('ieps_p') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('ieps_d') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="ieps_d">
                                        {{ __('IEPS D') }}
                                    </label>
                                    <input aria-describedby="ieps_dHelp" aria-required="true" class="form-control{{ $errors->has('ieps_d') ? ' is-invalid' : '' }}" id="input-ieps_d"  min="0" name="ieps_d"  step="0.0001"  type="number" value="{{ old('ieps_d', $estacion_edit->ieps_d) }}">
                                        @if ($errors->has('ieps_d'))
                                        <span class="error text-danger" for="input-ieps_d" id="ieps_d-error">
                                            {{ $errors->first('ieps_d') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group{{ $errors->has('utilidad_r') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="utilidad_r">
                                        {{ __('Utilidad R') }}
                                    </label>
                                    <input aria-describedby="utilidad_rHelp" aria-required="true" class="form-control{{ $errors->has('utilidad_r') ? ' is-invalid' : '' }}" id="input-utilidad_r" min="0" name="utilidad_r" step="0.0001"  type="number" value="{{ old('utilidad_r', $estacion_edit->utilidad_r) }}">
                                        @if ($errors->has('utilidad_r'))
                                        <span class="error text-danger" for="input-utilidad_r" id="utilidad_r-error">
                                            {{ $errors->first('utilidad_r') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('utilidad_p') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="utilidad_p">
                                        {{ __('Utilidad P') }}
                                    </label>
                                    <input aria-describedby="utilidad_pHelp" aria-required="true" class="form-control{{ $errors->has('utilidad_p') ? ' is-invalid' : '' }}" id="input-utilidad_p" min="0" name="utilidad_p" step="0.0001"  type="number" value="{{ old('utilidad_p', $estacion_edit->utilidad_p) }}">
                                        @if ($errors->has('utilidad_p'))
                                        <span class="error text-danger" for="input-utilidad_p" id="utilidad_p-error">
                                            {{ $errors->first('utilidad_p') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>
                                <div class="form-group{{ $errors->has('utilidad_d') ? ' has-danger' : '' }} col-sm-4">
                                    <label for="utilidad_d">
                                        {{ __('Utilidad D') }}
                                    </label>
                                    <input aria-describedby="utilidad_dHelp" aria-required="true" class="form-control{{ $errors->has('utilidad_d') ? ' is-invalid' : '' }}" id="input-utilidad_d" min="0" name="utilidad_d" step="0.0001"  type="number" value="{{ old('utilidad_d', $estacion_edit->utilidad_d) }}">
                                        @if ($errors->has('utilidad_d'))
                                        <span class="error text-danger" for="input-utilidad_d" id="utilidad_d-error">
                                            {{ $errors->first('utilidad_d') }}
                                        </span>
                                        @endif
                                    </input>
                                </div>

                            </div>

                            <div class="row mt-2">

                                <div class="form-group col-sm-4 text-center">
                                    <label for="credito">
                                        {{ __('Estatus activa') }}
                                    </label>
                                    <div class="togglebutton">
                                        <label>
                                            <input @if($estacion_edit->status == 1) checked="true" @endif name="status" type="checkbox">
                                                <span class="toggle">
                                                </span>
                                            </input>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 text-center">
                                    <label for="credito">
                                        {{ __('Activar Crédito') }}
                                    </label>
                                    <div class="togglebutton">
                                        <label>
                                            <input aria-controls="collapseExample" aria-expanded="false" data-toggle="collapse" href="#collapseExample" id="input-linea_credito" name="linea_credito" type="checkbox" @if($estacion_edit->linea_credito == 1) checked="true" @endif>
                                                <span class="toggle">
                                                </span>
                                            </input>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 text-center">
                                    <label for="credito">
                                        {{ __('Datos Fiscales') }}
                                    </label>
                                    <div class="togglebutton">
                                        <label>
                                            <input aria-controls="datosfiscales" aria-expanded="false" data-toggle="collapse" href="#datosfiscales" id="input-datos_fiscales" name="datos_fiscales" type="checkbox" @if($estacion_edit->datos_fiscales == 1) checked="true" @endif>
                                                <span class="toggle">
                                                </span>
                                            </input>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <div class="row mt-3">
                                    <div class="form-group{{ $errors->has('credito') ? ' has-danger' : '' }} col-sm-4">
                                        <label for="credito">
                                            {{ __('Credito') }}
                                        </label>
                                        <input aria-describedby="creditoHelp" aria-required="true" class="form-control{{ $errors->has('credito') ? ' is-invalid' : '' }}" id="input-credito" name="credito" required="true" type="number" value="{{ old('credito',$estacion_edit->credito) }}">
                                            @if ($errors->has('credito'))
                                            <span class="error text-danger" for="input-credito" id="credito-error">
                                                {{ $errors->first('credito') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <input class="form-control" id="input-credito_usado" name="credito_usado" type="hidden" value="{{$estacion_edit->credito_usado}}">
                                        <input class="form-control" id="input-saldo" name="saldo" type="hidden" value="{{$estacion_edit->saldo}}">
                                            <div class="form-group{{ $errors->has('dias_credito') ? ' has-danger' : '' }} col-sm-4">
                                                <label for="dias_credito">
                                                    {{ __('Dias credito') }}
                                                </label>
                                                <input aria-describedby="dias_creditoHelp" aria-required="true" class="form-control{{ $errors->has('dias_credito') ? ' is-invalid' : '' }}" id="input-dias_credito" name="dias_credito" required="true" type="number" value="{{ old('dias_credito',$estacion_edit->dias_credito) }}">
                                                    @if ($errors->has('dias_credito'))
                                                    <span class="error text-danger" for="input-dias_credito" id="dias_credito-error">
                                                        {{ $errors->first('dias_credito') }}
                                                    </span>
                                                    @endif
                                                </input>
                                            </div>
                                            <div class="form-group{{ $errors->has('retencion') ? ' has-danger' : '' }} col-sm-4">
                                                <label for="retencion">
                                                    {{ __('Retencion') }}
                                                </label>
                                                <input aria-describedby="retencionHelp" aria-required="true" class="form-control{{ $errors->has('retencion') ? ' is-invalid' : '' }}" id="input-retencion" name="retencion" required="true" type="number" value="{{ old('retencion',$estacion_edit->retencion) }}">
                                                    @if ($errors->has('retencion'))
                                                    <span class="error text-danger" for="input-retencion" id="retencion-error">
                                                        {{ $errors->first('retencion') }}
                                                    </span>
                                                    @endif
                                                </input>
                                            </div>
                                        </input>
                                    </input>
                                </div>
                            </div>
                            <div class="collapse" id="datosfiscales">
                                <div class="row mt-5">
                                    <div class="form-group{{ $errors->has('codigo_postal') ? ' has-danger' : '' }} col-sm-3">
                                        <label for="codigo_postal">
                                            {{ __('Codigo Postal') }}
                                        </label>
                                        <input aria-describedby="codigo_postalHelp" aria-required="true" class="form-control{{ $errors->has('codigo_postal') ? ' is-invalid' : '' }}" id="input-codigo_postal" name="codigo_postal" type="text" value="{{ old('codigo_postal',$estacion_edit->codigo_postal) }}">
                                            @if ($errors->has('codigo_postal'))
                                            <span class="error text-danger" for="input-codigo_postal" id="codigo_postal-error">
                                                {{ $errors->first('codigo_postal') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <div class="form-group{{ $errors->has('tipo_de_vialidad') ? ' has-danger' : '' }} col-sm-3">
                                        <label for="tipo_de_vialidad">
                                            {{ __('Tipo de vialidad') }}
                                        </label>
                                        <input aria-describedby="tipo_de_vialidadHelp" aria-required="true" class="form-control{{ $errors->has('tipo_de_vialidad') ? ' is-invalid' : '' }}" id="input-tipo_de_vialidad" name="tipo_de_vialidad" type="text" value="{{ old('tipo_de_vialidad',$estacion_edit->tipo_de_vialidad) }}">
                                            @if ($errors->has('tipo_de_vialidad'))
                                            <span class="error text-danger" for="input-tipo_de_vialidad" id="tipo_de_vialidad-error">
                                                {{ $errors->first('tipo_de_vialidad') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <div class="form-group{{ $errors->has('nombre_de_vialidad') ? ' has-danger' : '' }} col-sm-3">
                                        <label for="nombre_de_vialidad">
                                            {{ __('Nombre de la Vialidad') }}
                                        </label>
                                        <input aria-describedby="nombre_de_vialidadlHelp" aria-required="true" class="form-control{{ $errors->has('nombre_de_vialidad') ? ' is-invalid' : '' }}" id="input-nombre_de_vialidad" name="nombre_de_vialidad" type="text" value="{{ old('nombre_de_vialidad',$estacion_edit->nombre_de_vialidad) }}">
                                            @if ($errors->has('nombre_de_vialidad'))
                                            <span class="error text-danger" for="input-nombre_de_vialidad" id="nombre_de_vialidad-error">
                                                {{ $errors->first('nombre_de_vialidad') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <div class="form-group{{ $errors->has('n_exterior') ? ' has-danger' : '' }} col-sm-3">
                                        <label for="n_exterior">
                                            {{ __('n° exterior') }}
                                        </label>
                                        <input aria-describedby="n_exteriorHelp" aria-required="true" class="form-control{{ $errors->has('n_exterior') ? ' is-invalid' : '' }}" id="input-n_exterior" name="n_exterior" type="text" value="{{ old('n_exterior',$estacion_edit->n_exterior) }}">
                                            @if ($errors->has('n_exterior'))
                                            <span class="error text-danger" for="input-n_exterior" id="n_exterior-error">
                                                {{ $errors->first('n_exterior') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('n_interior') ? ' has-danger' : '' }} col-sm-4">
                                        <label for="n_interior">
                                            {{ __('n° interior') }}
                                        </label>
                                        <input aria-describedby="n_interiorlHelp" aria-required="true" class="form-control{{ $errors->has('n_interior') ? ' is-invalid' : '' }}" id="input-n_interior" name="n_interior" type="text" value="{{ old('n_interior',$estacion_edit->n_interior) }}">
                                            @if ($errors->has('n_interior'))
                                            <span class="error text-danger" for="input-n_interior" id="n_interior-error">
                                                {{ $errors->first('n_interior') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <div class="form-group{{ $errors->has('nombre_colonia') ? ' has-danger' : '' }} col-sm-4">
                                        <label for="nombre_colonia">
                                            {{ __('Nombre de la Colonia') }}
                                        </label>
                                        <input aria-describedby="nombre_colonialHelp" aria-required="true" class="form-control{{ $errors->has('nombre_colonia') ? ' is-invalid' : '' }}" id="input-nombre_colonia" name="nombre_colonia" type="text" value="{{ old('nombre_colonia',$estacion_edit->nombre_colonia) }}">
                                            @if ($errors->has('nombre_colonia'))
                                            <span class="error text-danger" for="input-nombre_colonia" id="nombre_colonia-error">
                                                {{ $errors->first('nombre_colonia') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <div class="form-group{{ $errors->has('nombre_localidad') ? ' has-danger' : '' }} col-sm-4">
                                        <label for="nombre_localidad">
                                            {{ __('Nombre de la Localidad') }}
                                        </label>
                                        <input aria-describedby="nombre_localidadlHelp" aria-required="true" class="form-control{{ $errors->has('nombre_localidad') ? ' is-invalid' : '' }}" id="input-nombre_localidad" name="nombre_localidad" type="text" value="{{ old('nombre_localidad',$estacion_edit->nombre_localidad) }}">
                                            @if ($errors->has('nombre_localidad'))
                                            <span class="error text-danger" for="input-nombre_localidad" id="nombre_localidad-error">
                                                {{ $errors->first('nombre_localidad') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('nombre_municipio_o_demarcacion_territorial') ? ' has-danger' : '' }} col-sm-6">
                                        <label for="nombre_municipio_o_demarcacion_territorial">
                                            {{ __('Nombre del Municipio o Demarcacion Territorial') }}
                                        </label>
                                        <input aria-describedby="nombre_municipio_o_demarcacion_territorialHelp" aria-required="true" class="form-control{{ $errors->has('nombre_municipio_o_demarcacion_territorial') ? ' is-invalid' : '' }}" id="input-nombre_municipio_o_demarcacion_territorial" name="nombre_municipio_o_demarcacion_territorial" type="text" value="{{ old('nombre_municipio_o_demarcacion_territorial',$estacion_edit->nombre_municipio_o_demarcacion_territorial) }}">
                                            @if ($errors->has('nombre_municipio_o_demarcacion_territorial'))
                                            <span class="error text-danger" for="input-nombre_municipio_o_demarcacion_territorial" id="nombre_municipio_o_demarcacion_territorial-error">
                                                {{ $errors->first('nombre_municipio_o_demarcacion_territorial') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <div class="form-group{{ $errors->has('nombre_entidad_federativa') ? ' has-danger' : '' }} col-sm-6">
                                        <label for="nombre_entidad_federativa">
                                            {{ __('Nombre de la entidad federativa') }}
                                        </label>
                                        <input aria-describedby="nombre_entidad_federativarlHelp" aria-required="true" class="form-control{{ $errors->has('nombre_entidad_federativa') ? ' is-invalid' : '' }}" id="input-nombre_entidad_federativa" name="nombre_entidad_federativa" type="text" value="{{ old('nombre_entidad_federativa',$estacion_edit->nombre_entidad_federativa) }}">
                                            @if ($errors->has('nombre_entidad_federativa'))
                                            <span class="error text-danger" for="input-nombre_entidad_federativa" id="nombre_entidad_federativa-error">
                                                {{ $errors->first('nombre_entidad_federativa') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="form-group{{ $errors->has('entre_calle') ? ' has-danger' : '' }} col-sm-6">
                                        <label for="entre_calle">
                                            {{ __('Entre Calle') }}
                                        </label>
                                        <input aria-describedby="entre_calleHelp" aria-required="true" class="form-control{{ $errors->has('entre_calle') ? ' is-invalid' : '' }}" id="input-entre_calle" name="entre_calle" type="text" value="{{ old('entre_calle',$estacion_edit->entre_calle) }}">
                                            @if ($errors->has('entre_calle'))
                                            <span class="error text-danger" for="input-entre_calle" id="entre_calle-error">
                                                {{ $errors->first('entre_calle') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                    <div class="form-group{{ $errors->has('y_calle') ? ' has-danger' : '' }} col-sm-6">
                                        <label for="y_calle">
                                            {{ __('y calle') }}
                                        </label>
                                        <input aria-describedby="y_calle" aria-required="true" class="form-control{{ $errors->has('y_calle') ? ' is-invalid' : '' }}" id="input-y_calle" name="y_calle" type="text" value="{{ old('y_calle',$estacion_edit->y_calle) }}">
                                            @if ($errors->has('y_calle'))
                                            <span class="error text-danger" for="input-y_calle" id="y_calle-error">
                                                {{ $errors->first('y_calle') }}
                                            </span>
                                            @endif
                                        </input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button class="btn btn-primary" type="submit">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
        if({{$estacion_edit->linea_credito}} == 1)
        {
          $('#collapseExample').collapse('show')  
        }

        if({{$estacion_edit->datos_fiscales}} == 1)
        {
          $('#datosfiscales').collapse('show')  
        }
        
    });
  </script>
@endpush

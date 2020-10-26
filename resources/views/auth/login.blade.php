@extends('layouts.app', ['class' => 'login-page', 'page' => __('inicio de sesión'), 'contentClass' => 'login-page'])

@section('content')
    
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-white">
                
                    <img class="mx-auto d-block mt-4" src="{{ asset('white') }}/img/mobil-logo.png" alt="" style="height:60px">
                
                <div class="card-body mt-3">
                    
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo electrónico') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Contraseña') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                    
                    <div class="input-group mt-4 mb-0">
                        <button type="submit" href="" class="btn btn-primary btn-lg btn-block">{{ __('Iniciar sesión') }}</button>
                    </div>
                </div>
                   
                <!--div class="card-footer mt-0">
                    <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Iniciar sesión') }}</button>
                    <div class="pull-right">
                        <h6>
                            <a href="{{ route('password.request') }}" class="link footer-link" >{{ __('¿Olvidaste tu contraseña?') }}</a>
                        </h6>
                    </div>
                </div-->
            </div>
        </form>
    </div>
@endsection

@extends('layouts.app', ['activePage' => 'Pedidos', 'titlePage' => __('Gestión de los pedidos')])

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
                                {{ __('Realizar Pedido') }}
                            </h4>
                            <p class="card-category">
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a class="btn btn-sm btn-primary" href="{{ route('pedidos.index') }}">
                                        {{ __('Volver a la lista') }}
                                    </a>
                                </div>
                                <div class="col-md-6" id="col-actualizacion" style="display: none;">
                                    <p>Precios actualizados <span id="span-fecha-ultima-actualizacion"></span></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                            	<div class="col-lg-3 col-md-6 col-sm-3">
                            		<label class="label-control">Estación</label>
                                	<select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" id="input-estacion_id" name="estacion_id">
                                  		<option disabled selected>-- Seleccionar --</option>
                                  		@foreach($estaciones as $estacion)
                                    		<option value="{{ $estacion->id }}">{{ $estacion->nombre_sucursal }}</option>
                                  		@endforeach
                                	</select>
                              	</div>

                              	<input type="hidden" name="status_id" value="1">

                              	<div class="col-lg-3 col-md-6 col-sm-3">
                              		<label class="label-control">Tipo de contenedor</label>
                                	<select class="selectpicker sele" data-style="btn btn-primary btn-round" title="Single Select" id="input-cantidad_lts" name="cantidad_lts">
                                  		<option disabled selected>-- Seleccionar --</option>
                                  		<option value="15500">15,500L</option>
                                  		<option value="21000">21,000L</option>
                                  		<option value="31000">31,000L (Full)</option>
                                  		<option value="42000">42,000L (Full)</option>
                                	</select>
                              	</div>

                              	<div class="col-lg-3 col-md-6 col-sm-3">
                              		<label class="label-control">Producto</label>
                                	<select class="selectpicker sele" data-style="btn btn-primary btn-round" title="Single Select" id="input-producto" name="producto">
                                  		<option disabled selected>-- Seleccionar --</option>
                                  		<option value="Extra">Extra</option>
                                  		<option value="Supreme">Supreme</option>
                                  		<option value="Diesel">Diesel</option>
                                	</select>
                              	</div>

                            </div>

                            <div class="row mt-4">

                            	<div class="form-group col-sm-3">
                                	<label class="label-control">Fecha de entrega</label>
                                	<input class="form-control datetimepicker" id="input-dia_entrega" name="dia_entrega" type="text" value="" placeholder="Fecha">
                            	</div>

                            	<div class="form-group{{ $errors->has('saldo') ? ' has-danger' : '' }} col-sm-3">
                            		<input type="hidden" id="input-saldo" name="saldo" value="">

                                	<label for="saldo1">{{ __('Saldo actual') }}</label>
                                	<input aria-describedby="saldo1Help" aria-required="true" class="form-control{{ $errors->has('saldo1') ? ' is-invalid' : '' }}"  id="input-saldo1" name="saldo1"  type="number" min="0.00" step="0.01" value="{{ old('saldo1',0)}}" readonly>
                                  	@if ($errors->has('saldo1'))
                                    <span class="error text-danger" for="input-saldo1" id="saldo1-error">
                                      {{ $errors->first('saldo1') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                              	<div class="form-group{{ $errors->has('credito') ? ' has-danger' : '' }} col-sm-3">

                              		<input type="hidden" id="precio_producto_extra">
                              		<input type="hidden" id="precio_producto_supreme">
                              		<input type="hidden" id="precio_producto_diesel">

                                	<label for="credito">{{ __('Linea de credito') }}</label>
                                	<input aria-describedby="creditoHelp" aria-required="true" class="form-control{{ $errors->has('credito') ? ' is-invalid' : '' }}"  id="input-credito" name="credito"  type="number" min="0.00" step="0.01" value="{{ old('credito',0)}}" readonly>
                                  	@if ($errors->has('credito'))
                                    <span class="error text-danger" for="input-credito" id="credito-error">
                                      {{ $errors->first('credito') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                            </div>

                            <div class="row mt-4">
                            	<div class="form-group{{ $errors->has('disponible') ? ' has-danger' : '' }} col-sm-3">
                                	<label for="disponible">{{ __('Credito disponible') }}</label>
                                	<input aria-describedby="numero_economicoHelp" aria-required="true" class="form-control{{ $errors->has('disponible') ? ' is-invalid' : '' }}"  id="input-disponible" name="disponible" type="number" min="0.00" step="0.01" value="{{ old('disponible',0)}}" readonly>
                                  	@if ($errors->has('disponible'))
                                    <span class="error text-danger" for="input-disponible" id="disponible-error">
                                      {{ $errors->first('disponible') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                              	<div class="form-group{{ $errors->has('numero_economico') ? ' has-danger' : '' }} col-sm-3">
                                	<label for="credito_usado">{{ __('Credito restante') }}</label>
                                	<input aria-describedby="credito_usadoHelp"  aria-required="true" class="form-control{{ $errors->has('numero_economico') ? ' is-invalid' : '' }}" id="input-credito_usado" name="credito_usado" type="number" min="0.00" step="0.01" value="{{ old('credito_usado',0)}}" readonly>
                                  	@if ($errors->has('credito_usado'))
                                    <span class="error text-danger" for="input-credito_usado" id="credito_usado-error">
                                      {{ $errors->first('credito_usado') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>

                              	<div class="form-group{{ $errors->has('costo_aprox') ? ' has-danger' : '' }} col-sm-3">
                                	<label for="costo_aprox">{{ __('Costo aproximado') }}</label>
                                	<input aria-describedby="costo_aproxHelp" aria-required="true" class="form-control{{ $errors->has('costo_aprox') ? ' is-invalid' : '' }}" id="input-costo_aprox" name="costo_aprox" type="number" min="0.00" step="0.01" value="{{ old('costo_aprox', 0)}}" readonly>
                                  	@if ($errors->has('costo_aprox'))
                                    <span class="error text-danger" for="input-costo_aprox" id="costo_aprox-error">
                                      {{ $errors->first('costo_aprox') }}
                                    </span>
                                  	@endif
                                	</input>
                              	</div>
                            </div>
                            {{-- <div class="row mt-4">
                              <div class="form-group{{ $errors->has('po') ? ' has-danger' : '' }} col-sm-3">
                                  <label for="po">{{ __('PO') }}</label>
                                  <input aria-describedby="poHelp" aria-required="true" class="form-control{{ $errors->has('po') ? ' is-invalid' : '' }}" id="input-po" name="po" type="text" value="{{ old('po')}}">
                                    @if ($errors->has('po'))
                                    <span class="error text-danger" for="input-po" id="po-error">
                                      {{ $errors->first('po') }}
                                    </span>
                                    @endif
                                  </input>
                                </div>
                            </div> --}}

                            <div class="card-footer ml-auto mr-auto" id="btn-guardar-div">
                                <button class="btn btn-primary ocultar" type="submit" id="guardar">
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
	$('#input-estacion_id').change(function(){

        $.ajax({
        	url: 'seleccionado',
        	type: 'POST',
        	dataType: 'json',
        	data: {
          		'id' : $('#input-estacion_id').val(),
        	},
        	headers:{
          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	success: function(response){
        		var datos =  response;
        		$('#input-saldo').val(datos.estacion.saldo);
        		$('#input-saldo1').val(datos.estacion.saldo);
        		$('#input-credito').val(datos.estacion.credito);
        		$('#input-disponible').val(dividir( multiplicar(datos.estacion.credito) - multiplicar(datos.estacion.credito_usado) ));
        		// $('#precio_producto_extra').val(datos.price[datos.price.length - 1].extra_u);
        		// $('#precio_producto_supreme').val(datos.price[datos.price.length - 1].supreme_u);
        		// $('#precio_producto_diesel').val(datos.price[datos.price.length - 1].diesel_u);
                $('#input-credito_usado').val(0);
                $('#input-costo_aprox').val(0);
          	//console.log( datos.price[datos.price.length - 1].extra_u );
            //console.log(parseFloat(datos.estacion.credito) - parseFloat(datos.estacion.credito_usado));
                if(datos.valores_ultima_actualizacion != null)
                {
                    document.getElementById('col-actualizacion').style.display = "block";
                    $('#span-fecha-ultima-actualizacion').text(datos.valores_ultima_actualizacion.fecha);

                    $('#precio_producto_extra').val(datos.valores_ultima_actualizacion.extra_u);
                    $('#precio_producto_supreme').val(datos.valores_ultima_actualizacion.supreme_u);
                    $('#precio_producto_diesel').val(datos.valores_ultima_actualizacion.diesel_u);

                }else{
                    $('#precio_producto_extra').val(datos.price[datos.price.length - 1].extra_u);
                    $('#precio_producto_supreme').val(datos.price[datos.price.length - 1].supreme_u);
                    $('#precio_producto_diesel').val(datos.price[datos.price.length - 1].diesel_u);
                }

                if(datos.hay_adeudo === 1)
                {
                    document.getElementById('btn-guardar-div').style.display = "none";
                    alert('La estación tiene un adeudo que no ha pagado y ya expiró el plazo de pago.');
                }else{
                    document.getElementById('btn-guardar-div').style.display = "block";
                }
        	}
      	})
    });

    function costo_aprox(){
    	if ($('#input-producto').val() == 'Extra') {

        $('#input-costo_aprox').val( dividir(dividir(multiplicar($('#precio_producto_extra').val()) * multiplicar( $('#input-cantidad_lts').val()))) );

    	} else if( $('#input-producto').val() == 'Supreme' ) {

        $('#input-costo_aprox').val( dividir(dividir(multiplicar($('#precio_producto_supreme').val()) * multiplicar( $('#input-cantidad_lts').val()))) );


    	} else if( $('#input-producto').val() == 'Diesel' ) {
        //alert(dividir(multiplicar($('#precio_producto_diesel').val()) * multiplicar( $('#input-cantidad_lts').val())) );
         $('#input-costo_aprox').val( dividir(dividir(multiplicar($('#precio_producto_diesel').val()) * multiplicar( $('#input-cantidad_lts').val()))) );

    	}

    }

    $('.sele').change(function(){

    	$('#input-credito_usado').val(0);
      $('#input-saldo1').val($('#input-saldo').val());
      $('#input-costo_aprox').val(0);

    	costo_aprox();

      if(parseFloat($('#input-saldo').val()) > 0 ) {
        //hay saldo

          if(parseFloat($('#input-costo_aprox').val()) <= parseFloat($('#input-saldo').val())){

            alert('se puede comprar con el saldo.');
            $('#input-saldo1').val($('#input-saldo').val() - $('#input-costo_aprox').val());
            $('#input-credito_usado').val($('#input-disponible').val());
            $("#guardar").removeClass("ocultar");

          }else{
            //el saldo no es suficiente

            //alert('hola');

            if(parseFloat($('#input-disponible').val()) >= 0 ){
              //se usara saldo y credito
              var suma_disponible_saldo = dividir( multiplicar(parseFloat($('#input-disponible').val())) + multiplicar(parseFloat($('#input-saldo').val())));
              var costo_apro = dividir(multiplicar(parseFloat( $('#input-costo_aprox').val())));

              if(suma_disponible_saldo >= costo_apro) {

                alert('credito y saldo suficientes para comprar');
                $('#input-saldo1').val(0);

                $('#input-credito_usado').val(dividir( multiplicar(suma_disponible_saldo) - multiplicar($('#input-costo_aprox').val())) ) ;
                $("#guardar").removeClass("ocultar");

              }else{

                $('#input-saldo1').val($('#input-saldo').val());

                alert('credito y saldo insuficientes para realizar la comprar');
                $("#guardar").addClass("ocultar");
              }

            }else{

               alert('credito insuficientes para comprar');
               $("#guardar").addClass("ocultar");

            }

        }



      }else{
        //no hay saldo
        //alert('hola1');
        //determinar si hay credito disponible suficiente
        if(parseFloat($('#input-disponible').val()) != 0 && parseFloat($('#input-disponible').val()) >= 100000){

          if(parseFloat($('#input-disponible').val()) > parseFloat( $('#input-costo_aprox').val())) {

            alert('no hay saldo pero si credito suficiente');
             $('#input-credito_usado').val(dividir( multiplicar($('#input-disponible').val()) - multiplicar($('#input-costo_aprox').val())) ) ;
             $("#guardar").removeClass("ocultar");

          }else{

            alert('credito insuficiente');
            $("#guardar").addClass("ocultar");

          }

        }

      }

    });

  @if(auth()->user()->roles[0]->name == 'Administrador' || auth()->user()->roles[0]->name == 'Logistica')
    init_calendar('input-dia_entrega', now(), '07-07-2025');
  @else
    init_calendar('input-dia_entrega', manana(), '07-07-2025');
  @endif

</script>
@endpush

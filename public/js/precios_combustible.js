function multiplicar(a) {
    return a * 1000;
}

function dividir(a) {
    return a / 1000;
}

function conseguir_valores(id, utilidad_r, utilidad_p, utilidad_d){

	$("#id").val(id);
	$("#utilidad_r").val(utilidad_r);
	$("#utilidad_p").val(utilidad_p);
	$("#utilidad_d").val(utilidad_d);
}

function suma_adictivo(id, id2, primer_valor) {
    $(document).on("keyup", "#" + id, function() {

    	var primer_resultado = dividir( multiplicar($("#"+primer_valor).val()) * 0.16 ); 
    	var segundo_resultado = dividir( multiplicar(primer_resultado.toFixed(2)) + multiplicar($("#"+primer_valor).val()) ); 
    	var suma = dividir( multiplicar($("#" + id).val()) - multiplicar(segundo_resultado.toFixed(2)) );

        if ($("#" + id).val() == '') {
        	$("#" + id2).val('0');
        } else {
        	$("#" + id2).val(suma);
        }
        
    });
}


function so_number(id,estacion){
    $("#input-estacion_id").val(id);
    $("#input-estacion").val(estacion);
}

function autorizar(id,estacion,order_id){
    $("#input-id").val(id);
    $("#input-estacion_name").val(estacion);
    $("#order_id").val(order_id);

     //ajax para buscar las pipas relaciondas con el tractor de la estación
    $.ajax({
        url: 'pedidos/getpipes/'+id+'',
        type: 'GET',
        dataType: 'json',
        success: function(response){
            $('#input-tractor_id').children('option:not(:first)').remove();
            for(i=0; i<response.pipas.length; i++){
                $('#input-id_pipe').append('<option value="'+response.pipas[i].id+'">'+response.pipas[i].numero_economico+' - '+response.pipas[i].capacidad+'</option>');  
            }
            $('#input-id_pipe').selectpicker('render');
            $('#input-id_pipe').selectpicker('refresh');
        }
    });
}

function envio_emergencia(order_id){
    $("#order_id_e").val(order_id);
    //alert($("#order_id_e").val());
}
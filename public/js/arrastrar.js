/*$(function() {
    numero_de_pedidos = 1;
    capacidad_total_compartimientos = 0;
    capacidad_total_pedidos = 0;

    $("#allFacets, #userFacets").sortable({
      connectWith: "ul",
      placeholder: "placeholder",
      delay: 100,
      remove: function( event, ui ) {
        pipas = [];

        for(i=0; i<$("#input-pipa_id option:selected").length; i++){
          // console.log($('#input-pipa_id option:eq('+i+')').val());
          pipas.push($('#input-pipa_id option:eq('+i+')').val());
        }

        $.ajax({
          url: '../../control/pipa_escogida',
          type: 'POST',
          dataType: 'json',
          data: {
              '_token': $('input[name=_token]').val(),
              'pipas_ids' : pipas,
          },
          headers:{ 
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
          },
          success: function(response){
            // console.log(response);

            numero_de_pedidos = 0;
            capacidad_total = 0;

            for(i=0; i<response.pipas.length; i++){
              numero_de_pedidos = numero_de_pedidos + parseInt(response.pipas[i].compartimentos);
              capacidad_total_compartimientos = capacidad_total_compartimientos + parseInt(response.pipas[i].capacidad);
            }
          },
          error: function(error){
          }
        });

        // if que valida que los selects no tengan valores nulos
        if($("#input-pipa_id").val() != [] && $("#input-tractor_id").val() != [] && $("#input-terminal_id").val() != [] && $("#input-conductor_id").val() != [] &&  $("#fletera").val() != []) {
          // llamamos a la etiqueta donde estan los pedios a armar el flete
          el = document.getElementById('userFacets');
          // listamos los li del ul
          els = el.getElementsByTagName('li');
          // array para saber cuantos pedidos hay en ul
          vec=[];
          // for para recorrer esos pedios en el ul
          for(i=0; i<els.length;i++){
              if(els[i].parentNode==el)
                  vec.push(els[i]);
                  capacidad_total_pedidos = capacidad_total_pedidos + parseInt(el.getElementsByTagName('li').item(i).value);
                  // console.log(el.getElementsByTagName('li').item(i).value);
          }

          console.log(capacidad_total_compartimientos);

          // if para validar que el tamaño de los pedidos no sobrepase la cantidad admitida
          if(vec.length > numero_de_pedidos){
            alert('solo pude haber '+numero_de_pedidos+' pedidos');
            // console.log($("#input-pipa_id option:selected").attr("name"));
            return false;
          } else{
            capacidad_total_compartimientos = 0;
            if(capacidad_total_pedidos > capacidad_total_compartimientos){
              alert('capacidad exedida.');
              return false;
            }
            // console.log(el.getElementsByTagName('li').item(0).value);
          }
        } else {
          alert('completa el formulario');
          return false;
        }
        
      }
    })
    .disableSelection()
    .dblclick( function(e){
      var item = e.target;
      if (e.currentTarget.id === 'allFacets') {
        //move from all to user
        $(item).fadeOut('fast', function() {
          $(item).appendTo($('#userFacets')).fadeIn('slow');
        });
      } else {
        
        //move from user to all
        $(item).fadeOut('fast', function() {
          $(item).appendTo($('#allFacets')).fadeIn('slow');
        });
      }
    });

  });*/


  $(function() {

    numero_de_pedidos = 1;
    capacidad_total_compartimientos = 0;
    capacidad_total_pedidos = 0;
    // lista de pedidos
    $("#allFacets").sortable({
      connectWith: "ul",
      placeholder: "placeholder",
      delay: 100,
      remove: function( event, ui ){

        pipas = $('#input-pipa_id').prop('selected', true).val();
        
        $.ajax({
          url: '../../control/pipa_escogida',
          type: 'POST',
          dataType: 'json',
          data: {
              '_token': $('input[name=_token]').val(),
              'pipas_ids' : pipas,
          },
          headers:{ 
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
          },
          success: function(response){
            // console.log(response);

            numero_de_pedidos = 0;
            capacidad_total = 0;
            capacidad_total_compartimientos = 0;

            for(i=0; i<response.pipas.length; i++){
              numero_de_pedidos = numero_de_pedidos + parseInt(response.pipas[i].compartimentos);
              capacidad_total_compartimientos = capacidad_total_compartimientos + parseInt(response.pipas[i].capacidad);
            }
          },
          error: function(error){
          }
        });

        // if que valida que los selects no tengan valores nulos
        if($("#input-pipa_id").val() != [] && $("#input-tractor_id").val() != [] && $("#input-terminal_id").val() != [] && $("#input-conductor_id").val() != [] &&  $("#fletera").val() != [] &&  $("#dia_entrega").val() != '') {
          // llamamos a la etiqueta donde estan los pedios a armar el flete
          el = document.getElementById('userFacets');
          // listamos los li del ul
          els = el.getElementsByTagName('li');
          // array para saber cuantos pedidos hay en ul
          vec=[];
          // for para recorrer esos pedios en el ul
          for(i=0; i<els.length;i++){
              if(els[i].parentNode==el)
                  vec.push(els[i]);
                  capacidad_total_pedidos = capacidad_total_pedidos + parseInt(el.getElementsByTagName('li').item(i).value);
                  // console.log(el.getElementsByTagName('li').item(i).value);
          }

          console.log(capacidad_total_compartimientos);

          // if para validar que el tamaño de los pedidos no sobrepase la cantidad admitida
          if(vec.length > numero_de_pedidos){
            //alert('solo pude haber '+numero_de_pedidos+' pedidos');
            demo.showNotification('top','center','solo pude haber '+numero_de_pedidos+' pedidos', 'tim-icons icon-bell-55');
            // console.log($("#input-pipa_id option:selected").attr("name"));
            return false;
          } else{
            if(capacidad_total_pedidos > capacidad_total_compartimientos){
              capacidad_total_compartimientos = 0;
              capacidad_total_pedidos = 0;
              demo.showNotification('top','center','capacidad exedida.', 'tim-icons icon-bell-55');
              // alert('capacidad exedida.');
              return false;
            }
            // console.log(el.getElementsByTagName('li').item(0).value);
          }
        } else {
          //alert('completa el formulario');
          demo.showNotification('top','center','completa el formulario', 'tim-icons icon-bell-55');
          return false;
        }
        
      
      } 
    })
    .disableSelection()
    .dblclick( function(e){
      var item = e.target;
        //move from all to user
        $(item).fadeOut('fast', function() {
          $(item).appendTo($('#userFacets')).fadeIn('slow');
        });
      
    });


    // lista de pedidos para armar flete
    
    $("#userFacets").sortable({
      connectWith: "ul",
      placeholder: "placeholder",
      delay: 100,
      receive: function( event, ui ){
        // alert('cambio lista 2');
        capacidad_total_compartimientos = 0;
        capacidad_total_pedidos = 0;
      },
      remove: function( event, ui ){
        // alert('cambio lista 2');
        capacidad_total_compartimientos = 0;
        capacidad_total_pedidos = 0;
      }
    })
    .disableSelection()
    .dblclick( function(e){
      var item = e.target;
        //move from all to user
        $(item).fadeOut('fast', function() {
          $(item).appendTo($('#allFacets')).fadeIn('slow');
        });
     
    });

  });
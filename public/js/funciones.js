var idioma_espanol = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }



    


function cuadros(cuadroOcultar, cuadroMostrar){
    $(cuadroOcultar).slideUp("slow"); //oculta el cuadro.
    $(cuadroMostrar).slideDown("slow"); //muestra el cuadro.
}


function nuevo(cuadroOcultar, cuadroMostrar){
	cuadros("#cuadro1", "#cuadro2");

    $("#alertas").css("display", "none");


	$("#form_store")[0].reset();
}

function regresar(cuadro) {
	cuadros(cuadro, "#cuadro1");
    listar();
}






function enviarFormulario(form, controlador, cuadro){
    $(form).submit(function(e){
        e.preventDefault(); //previene el comportamiento por defecto del formulario al darle click al input submit
        //var url=document.getElementById('ruta').value; //obtiene la ruta del input hidden con la variable <?=base_url()?>
        var formData = new FormData($(form)[0]); //obtiene todos los datos de los inputs del formulario pasado por parametros
        var method   = $(this).attr('method'); //obtiene el method del formulario
        $('input[type="submit"]').attr('disabled','disabled'); //desactiva el input submit

        $.ajax({
            url:controlador,
            type:method,
            dataType:'JSON',
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            beforeSend: function(){
                mensajes('info', '<span>Guardando datos, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
            },
            error: function (repuesta) {
            	console.log(repuesta);
                $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                var errores=repuesta.responseText;
                if(errores!="")
                    mensajes('danger', errores);
                else
                    mensajes('danger', "<span>Ha ocurrido un error, por favor intentelo de nuevo.</span>");        
            },
             success: function(respuesta){

                if (respuesta.success == false) {

                	var error = "";
                	$.each(respuesta.error, function(i, item){
                		error = error+item+"<br>";
                	});

                    mensajes('danger', error);
                    $('input[type="submit"]').removeAttr('disabled'); //activa el input submit

                }else{

                	console.log(respuesta);
                    $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                    mensajes('success', respuesta.message);

                    if(cuadro!="")
                        listar(cuadro);
                }

            }

        });
    });
}








function eliminarConfirmacionAjax(controlador, id, title){
    swal({
        title: title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: true,
        closeOnCancel: false
    },
    function(isConfirm){
        if (isConfirm) {
            swal.close();
           
            $.ajax({
                url:controlador,
                type: 'GET',
                dataType: 'JSON',
                data:{
                    id:id,
                },
                beforeSend: function(){
                    mensajes('info', '<span>Eliminando datos, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
                },
                error: function (repuesta) {
                    var errores=repuesta.responseText;
                    mensajes('danger', errores);
                },
                success: function(respuesta){
                    listar();
                    if (respuesta.success == false) {

                        var error = "";
                        $.each(respuesta.error, function(i, item){
                            error = error+item+"<br>";
                        });

                        mensajes('danger', error);
                        $('input[type="submit"]').removeAttr('disabled'); //activa el input submit

                    }else{

                        console.log(respuesta);
                        $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                        mensajes('success', respuesta.message);
                    }
                }
            });
        } else {
            swal("Cancelado", "No se ha eliminado el registro", "error");
        }
    });
}






function mensajes(type, msj){
    html='<div class="alert alert-'+type+'" role="alert">';
    html+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    html+=msj;
    html+='</div>';
    return $("#alertas").html(html).css("display", "block");
}






function validNick(e) {
  
    key               = e.keyCode || e.which;
    teclado           = String.fromCharCode(key);
    numeros           = "qwertyuiopasdfghjklñzxcvbnmQWERTYUIOPASDFGHJKLÑZXCVBNM1234567890_";
    especiales        = "8-9-17-37-38-46";//los numeros de esta linea son especiales y es para las flechass
    teclado_escpecial = false;
    for(var i in especiales)
        if (key==especiales[i])
            teclado_escpecial=true;
    if (numeros.indexOf(teclado)==-1 && !teclado_escpecial)
        return false;
}



function validaPassword(tx) 
{ 
    var nMay = 0, nMin = 0, nNum = 0 
    var t1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ" 
    var t2 = "abcdefghijklmnopqrstuvwxyz" 
    var t3 = "0123456789"

       if (tx.length < 4) {
               // console.log("Su password, debe tener almenos 5 letras");
       } else {
              //Aqui continua si la variable ya tiene mas de 5 letras
            for (i=0;i<tx.length;i++) { 
                if ( t1.indexOf(tx.charAt(i)) != -1 ) {nMay++} 
                if ( t2.indexOf(tx.charAt(i)) != -1 ) {nMin++} 
                if ( t3.indexOf(tx.charAt(i)) != -1 ) {nNum++} 
            } 
            if ( nMay>0 && nMin>0 && nNum>0 ) 
                $("#alertas").css("display", "none");
            else 
            { mensajes('danger', "Su password debe contener mínimo una mayúscula, minuscula y un número");  return; }
        }
}

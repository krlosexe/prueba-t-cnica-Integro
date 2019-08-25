@extends('layouts.app')

@section('content')
<div class="container">
    <div id="alertas"></div>
    <div class="row clearfix justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Usuarios</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('users/gestion')
                    @include('users/new')
                    @include('users/view')
                    @include('users/edit')
              

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>

        $(document).ready(function(){
            store();
            update();
        });

        listar();



        function listar(cuadro) {

            $('#tabla tbody').off('click');

             $.ajax({
                url: "get-users",
                type:'GET',
                dataType:'JSON',
                beforeSend: function(){
                    //mensajes('info', '<span>espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
                    $("#tabla tbody").html('<tr><td colspan="3">cargando... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></td></tr>');
                },
                error: function (repuesta) {
                    $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                    var errores=repuesta.responseText;
                    if(errores!="")
                        mensajes('danger', errores);
                    else
                        mensajes('danger', "<span>Ha ocurrido un error, por favor intentelo de nuevo.</span>");        
                },
                success: function(respuesta){
                   
                    var html = ""; 
                    $.each(respuesta, function(i, item){
                     
                        html+= "<tr>";
                             html += "<td>"+item.name+"</td>";
                             html += "<td>"+item.nick+"</td>";
                             html += "<td>";
                                html += "<span onclick='ver(this)' data='"+JSON.stringify(item)+"' class='consultar btn btn-xs btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='fa fa-eye' style='margin-bottom:5px'></i></span> ";

                                html += "<span onclick='edit(this)' data='"+JSON.stringify(item)+"'  class='editar btn btn-xs btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='fa fa-pencil-square-o' style='margin-bottom:5px'></i></span> ";

                                html += "<span onclick='eliminar(this)' data='"+JSON.stringify(item)+"' class='eliminar btn btn-xs btn-danger waves-effect' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash-o' style='margin-bottom:5px'></i></span>";
                            html += "</td>";

                        html += "</tr>";
                    });

                    $("#tabla tbody").html(html);
                }
             });

            cuadros(cuadro, "#cuadro1");
           
        }



        function ver(data) {
            var data = JSON.parse($(data).attr("data"));

            $("#alertas").css("display", "none");

            $("#name_view").val(data.name).attr("disabled", "disabled");
            $("#nick_view").val(data.nick).attr("disabled", "disabled");
            cuadros("#cuadro1", "#cuadro3");
        }



        function edit(data) {
            var data = JSON.parse($(data).attr("data"));

            $("#alertas").css("display", "none");

            $("#form_update")[0].reset();


            $("#name_edit").val(data.name);
            $("#nick_edit, #nick_old").val(data.nick);
            $("#id").val(data.id);
            cuadros("#cuadro1", "#cuadro4");
        }




        function eliminar(data){
           
            var data = JSON.parse($(data).attr("data"));

            eliminarConfirmacionAjax('delete-user', data.id, "¿Esta seguro de eliminar el registro?");
           
        }







        function store(){
            enviarFormulario("#form_store", 'store-user', '#cuadro2');
        }


        function update(){
            enviarFormulario("#form_update", 'update-user', '#cuadro4');
        }
    </script>   

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div id="alertas"></div>
    <div class="row clearfix justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Peliculas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('peliculas/gestion')
                    @include('peliculas/new')
                    @include('peliculas/view')
                    @include('peliculas/edit')
              

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
                url: "get-peliculas",
                type:'GET',
                dataType:'JSON',
                beforeSend: function(){
                    //mensajes('info', '<span>espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
                    $("#tabla tbody").html('<tr><td colspan="4">cargando... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></td></tr>');
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
                             html += "<td>"+item.tittle+"</td>";
                             html += "<td>"+item.sinopsis+"</td>";
                             html += "<td>"+item.year+"</td>";
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

            $("#tittle_view").val(data.tittle).attr("disabled", "disabled");
            $("#sinopsis_view").val(data.sinopsis).attr("disabled", "disabled");
            $("#year_view").val(data.year).attr("disabled", "disabled");

            cuadros("#cuadro1", "#cuadro3");
        }



        function edit(data) {

            var data = JSON.parse($(data).attr("data"));

            $("#alertas").css("display", "none");

            $("#form_update")[0].reset();

            $("#tittle_edit").val(data.tittle);
            $("#sinopsis_edit").val(data.sinopsis);
            $("#year_edit").val(data.year);

            $("#id").val(data.id);
            cuadros("#cuadro1", "#cuadro4");

        }




        function eliminar(data){
           
            var data = JSON.parse($(data).attr("data"));

            eliminarConfirmacionAjax('delete-pelicula', data.id, "¿Esta seguro de eliminar el registro?");
           
        }







        function store(){
            enviarFormulario("#form_store", 'store-peliculas', '#cuadro2');
        }


        function update(){
            enviarFormulario("#form_update", 'update-peliculas', '#cuadro4');
        }
    </script>   

@endsection

<div class="clearfix  ocultar" id="cuadro3">
    <div class="card">

       <div class="card-header">Consulta</div>
    	<br>
         <form name="form_descuento_registrar" id="form_view" method="post">
            

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name_view" type="text" class="form-control" name="name" required autocomplete="name" autofocus minlength="5">
                </div>
            </div>

            <div class="form-group row">
                <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

                <div class="col-md-6">
                    <input id="nick_view" type="text" class="form-control " name="nick"  required autocomplete="nick" onkeypress="return validNick(event)" >
                </div>
            </div>

            <br>
            <center class="">
                <button type="button" onclick="regresar('#cuadro3')" class="btn btn-primary waves-effect">Regresar</button>
            </center>
        </form>


        <br>

    </div>
</div>
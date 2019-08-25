<div class="clearfix  ocultar" id="cuadro4">
    <div class="card">

       <div class="card-header">Editar</div>
    	<br>
         <form name="form_descuento_registrar" id="form_update" method="post">
            
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name_edit" type="text" class="form-control" name="name" required autocomplete="name" autofocus minlength="5">
                </div>
            </div>

            <div class="form-group row">
                <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

                <div class="col-md-6">
                    <input id="nick_edit" type="text" class="form-control " name="nick"  required autocomplete="nick" onkeypress="return validNick(event)" >
                </div>
            </div>



            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>


            <input type="hidden" name="id" id="id">
            <input type="hidden" name="nick_old" id="nick_old">

            <br>
            <center class="">
                <button type="button" onclick="regresar('#cuadro4')" class="btn btn-primary waves-effect">Regresar</button>
                <input type="submit" value="Guardar" class="btn btn-success waves-effect">
            </center>
        </form>


        <br>

    </div>
</div>
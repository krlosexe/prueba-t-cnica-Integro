<div class="clearfix  ocultar" id="cuadro2">
    <div class="card">
        <div class="card-header">Registrar</div>
    	<br>
         <form name="form_descuento_registrar" id="form_store" method="post">
            
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus minlength="5">
                </div>
            </div>

            <div class="form-group row">
                <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

                <div class="col-md-6">
                    <input id="nick" type="text" class="form-control @error('nick') is-invalid @enderror" name="nick" value="{{ old('nick') }}" required autocomplete="nick" onkeypress="return validNick(event)" >
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" onkeyup="validaPassword(this.value)">
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <br>
            <center class="">
                <button type="button" onclick="regresar('#cuadro2')" class="btn btn-primary waves-effect">Regresar</button>
                <input type="submit" value="Guardar" class="btn btn-success waves-effect">
            </center>
        </form>


        <br>

    </div>
</div>
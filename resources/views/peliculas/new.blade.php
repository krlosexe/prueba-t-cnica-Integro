<div class="clearfix  ocultar" id="cuadro2">
    <div class="card">
        <div class="card-header">Registrar</div>
    	<br>
         <form name="form_descuento_registrar" id="form_store" method="post">
            
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Titulo*') }}</label>

                <div class="col-md-6">
                    <input id="tittle" type="text" class="form-control @error('name') is-invalid @enderror" name="tittle" value="{{ old('tittle') }}" required autocomplete="name" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Sinopsis') }}</label>

                <div class="col-md-6">
                    <input id="sinopsis" type="text" class="form-control @error('sinopsis') is-invalid @enderror" name="sinopsis" value="{{ old('sinopsis') }}" autocomplete="sinopsis">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Año') }}</label>

                <div class="col-md-3">
                    <input id="year" type="number" class="form-control @error('year') is-invalid @enderror" name="year" required autocomplete="new-year" max="<?= date("Y")?>">
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
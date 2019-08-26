<div class="clearfix  ocultar" id="cuadro4">
    <div class="card">

       <div class="card-header">Editar</div>
    	<br>
         <form name="form_descuento_registrar" id="form_update" method="post">
            
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Titulo*') }}</label>

                <div class="col-md-6">
                    <input id="tittle_edit" type="text" class="form-control @error('name') is-invalid @enderror" name="tittle" value="{{ old('tittle') }}" required autocomplete="name" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="sinopsis_edit" class="col-md-4 col-form-label text-md-right">{{ __('Sinopsis') }}</label>

                <div class="col-md-6">
                    <textarea class="form-control" name="sinopsis" id="sinopsis_edit" cols="30" rows="5"></textarea>
                    
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Año') }}</label>

                <div class="col-md-3">
                    <input id="year_edit" type="number" class="form-control @error('year') is-invalid @enderror" name="year" required autocomplete="new-year" max="<?= date("Y")?>">
                </div>
            </div>


            <input type="hidden" name="id" id="id">

            <br>
            <center class="">
                <button type="button" onclick="regresar('#cuadro4')" class="btn btn-primary waves-effect">Regresar</button>
                <input type="submit" value="Guardar" class="btn btn-success waves-effect">
            </center>
        </form>


        <br>

    </div>
</div>
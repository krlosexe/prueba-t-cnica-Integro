<div class="clearfix  ocultar" id="cuadro3">
    <div class="card">

       <div class="card-header">Consulta</div>
    	<br>
         <form name="form_descuento_registrar" id="form_view" method="post">
            

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Titulo*') }}</label>

                <div class="col-md-6">
                    <input id="tittle_view" type="text" class="form-control @error('name') is-invalid @enderror" name="tittle" value="{{ old('tittle') }}" required autocomplete="name" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="sinopsis_view" class="col-md-4 col-form-label text-md-right">{{ __('Sinopsis') }}</label>

                <div class="col-md-6">
                    <textarea class="form-control" name="sinopsis" id="sinopsis_view" cols="30" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Año') }}</label>

                <div class="col-md-3">
                    <input id="year_view" type="number" class="form-control @error('year') is-invalid @enderror" name="year" required autocomplete="new-year" max="<?= date("Y")?>">
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
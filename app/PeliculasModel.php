<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeliculasModel extends Model
{
   public $table = "peliculas";

   protected $fillable = [
        'tittle', 'sinopsis', 'year'
    ];

    public $timestamps = false;

}

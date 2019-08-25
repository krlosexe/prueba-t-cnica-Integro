<?php

namespace App\Http\Controllers;

use App\PeliculasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Peliculas extends Controller
{


	public function select()
	{
		$users = PeliculasModel::orderBy('id', 'desc')->get();
        return json_encode($users);
	}


    public function store(Request $request){

    	$year_actual = date("Y");

    	if ($request["year"] > $year_actual ) {
    		
    		return response()->json(['success'=> false, 'error' => array("solo acepta a#os menor o igual al actual")]);
    	}

    	$validator =  Validator::make($request->all(), [
            'tittle'    => ['required', 'string', 'max:255'],
            'sinopsis'  => ['required', 'string', 'max:700'],
            'year'      => ['required', 'int'],
        ]);


    	if($validator->fails()) {
        	return response()->json(['success'=> false, 'error'=> $validator->messages()->all()]);
        }


       try{
            $store = PeliculasModel::create($request->all());
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'error'=> $e->getMessage()]);
        }

        return response()->json(['success'=> true, 'message'=> 'La pelicula ha sido registrada.']);

    }


    public function update(Request $request)
    {	
    	$validator =  Validator::make($request->all(), [
            'tittle'    => ['required', 'string', 'max:255'],
            'sinopsis'  => ['required', 'string', 'max:700'],
            'year'      => ['required', 'int'],
        ]);


        if($validator->fails()) {
        	return response()->json(['success'=> false, 'error'=> $validator->messages()->all()]);
        }


        try{
            $peli = PeliculasModel::find($request["id"]);

            if ($peli == false) {
               return response()->json(['success'=> false, 'error'=> array("No se encontro")]);
            }

            $peli->update($request->all());

        }catch(\Exception $e){
            return response()->json(['success'=> false, 'error'=> $e->getMessage()]);
        }

        return response()->json(['success'=> true, 'message'=> 'La pelicula ha sido modificada.']);

    }


    public function delete(Request $request)
    {
    	try{
            $peli = PeliculasModel::find($request["id"]);

            if ($peli == false) {
               return response()->json(['success'=> false, 'error'=> array("No se encontro")]);
            }

            $peli->delete();

        }catch(\Exception $e){
            return response()->json(['success'=> false, 'error'=> $e->getMessage()]);
        }
        return response()->json(['success'=> true, 'message'=> 'La pelicula ha sido eliminada.']);
    }

}
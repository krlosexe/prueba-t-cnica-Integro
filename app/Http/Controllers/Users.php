<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Users extends Controller
{
    public function storeUser(Request $request){

    	$validator =  Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255', 'min:5'],
            'nick'     => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);


        $reg_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*)([A-Za-z\d$@$!%*?&]|[^ ]){4,150}$/';

        if(!preg_match($reg_password, $request["password"])) {
            return response()->json(['success'=> false, 'error'=> array("Su password debe contener mínimo una mayúscula, minuscula y un número")]);
        }

        if($validator->fails()) {
        	return response()->json(['success'=> false, 'error'=> $validator->messages()->all()]);
        }
        	
	    try{
            $store =  User::create([
	            'name'     => $request['name'],
	            'nick'     => $request['nick'],
	            'password' => Hash::make($request['password']),
	       ]);
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'error'=> $e->getMessage()]);
        }

        return response()->json(['success'=> true, 'message'=> 'El usuario ha sido registrado.']);

    }



    public function getUsers()
    {
    	$users = User::where("admin", 0)->orderBy('id', 'desc')->get();
        return json_encode($users);
    }



    public function updateUser(Request $request)
    {

    	$validator =  Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255', 'min:5'],
            'nick'     => ['required', 'string', 'max:255',$request["nick"] != $request["nick_old"] ? 'unique:users' : ''],
            'password' => [$request["password"] != null ? 'min:4' : '', $request["password"] != null ? 'confirmed' : ''],
        ]);




        if($validator->fails()) {
        	return response()->json(['success'=> false, 'error'=> $validator->messages()->all()]);
        }

        
        try{
            $user = User::find($request["id"]);

            if ($user == false) {
               return response()->json(['success'=> false, 'error'=> array("No se encontro")]);
            }

            $user->name = $request["name"];
            $user->nick = $request["nick"];

           if ($request["password"] != null) {
           	 $user->password =  Hash::make($request["password"]);
           }
            $user->save();

        }catch(\Exception $e){
            return response()->json(['success'=> false, 'error'=> $e->getMessage()]);
        }

        return response()->json(['success'=> true, 'message'=> 'El usuario ha sido modificado.']);

    }


    public function deleteUser(Request $request)
    {

    	try{
            $user = User::find($request["id"]);

            if ($user == false) {
               return response()->json(['success'=> false, 'error'=> array("No se encontro")]);
            }

            $user->delete();

        }catch(\Exception $e){
            return response()->json(['success'=> false, 'error'=> $e->getMessage()]);
        }
        return response()->json(['success'=> true, 'message'=> 'El usuario ha sido eliminado.']);

    }
}
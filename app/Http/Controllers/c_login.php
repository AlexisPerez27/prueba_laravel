<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\usuarios;
use Session;

class c_login extends Controller
{
    // NOTA ADMIN: EN EL ARCHIVO DE CONFIUGURACION SE PUEDE CAMBIAR EL TIEMPO QUE UNA SESION SE DEBE DE CERRAR
    // AHI SE CAMBIA EL EXPIREON A TRUE Y EL TIEMPO EN HORAS QUE DURA LA SESION ABIERTA
    public function login(){
        return view('login');
    }

    public function valida_sesion(Request $request){
        // de estamnera se realizan la validaciones
        $this->validate($request, [
            // la validacion regex es para hacer validaciones peronalizadas
            //'clave'     => 'required|regex:/^[E][M][P][-][0-9]{5}$/', //regex = letra E,M,P,guion y 5 numeros
            // regex= primera mayuscula, letras mayuscvyulas y minusculas y con espacios, se le pone + para decir que la cadena continua
            // regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/
            // ejemplo para decimales regex:/^[0-9]+[.][0-]{2}$/
            'usuario'   => 'required',
            'contra'    => 'required',
        ]);

        // para encriptar contraseña con hash
        // echo $contra_encrip = Hash::make($request -> contra);
        $consulta = usuarios::where('email',$request -> usuario)
        ->where('activo','Si')
        ->get();

        $cuantos = count($consulta);

        if($cuantos == 1 && Hash::check($request -> contra, $consulta[0]->pass)){
            Session::put('sessionusuario',$consulta[0]->nombre. " ". $consulta[0]->apellidos);
            Session::put('sessiontipo',$consulta[0]->tipo);
            Session::put('sessionid_usu',$consulta[0]->id_usuario);
            return redirect()->route('principal');
        }else{
            Session::flash('mensaje', "El usuario o la contraseña son incorrectos");
            return redirect()->route('iniciar_sesion');
        }
    }

    public function principal(){
        $id_usuario = session('sessionid_usu');

        if($id_usuario != ""){
            return view('principal');
        }else{
            Session::flash('mensaje', "Debes loguearse antes de continuar");
            return redirect()->route('iniciar_sesion');
        }
    }

    public function cerrar_sesion(){
        Session::forget('sessionid_usu');
        Session::forget('sessionusuario');
        Session::forget('sessiontipo');
        Session::flush();
        Session::flash('mensaje', "Sesion cerrada correctamente");
            return redirect()->route('iniciar_sesion');
    }
}

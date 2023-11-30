<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;
use App\Models\departamentos;
use App\Models\nominas;
use Session;

class c_empleados extends Controller
{
    public function alta_empleado(){
        $id_usuario = session('sessionid_usu');
        $tipo       = session('sessiontipo');

        if($id_usuario != "" and $tipo != ""){

            // parea obtener el maximo id en la bd
            $max_id = empleados::orderBy('id_emp', 'desc')->take(1)->get();

            // contamos los registros obtenidos
            $id = count($max_id);

            // si los registros son 0
            if ($id == 0) {
                $id_sig = 1; // se coloca la variable en 1
            } else {
                // hay registros se suma 1 al ultimo registro obtenido
                $id_sig = $max_id[0]->id_emp + 1;
            }

            // consulta para obtener los departamentos
            $departamentos = departamentos::orderBy('depto')->get();

            return view("alta_empleado")
            ->with('id_sig', $id_sig)
            ->with('departamentos', $departamentos);
        }
    }

    public function guarda_emp(Request $request){

        // de estamnera se realizan la validaciones
        $this->validate($request, [
            // la validacion regex es para hacer validaciones peronalizadas
            //'clave'     => 'required|regex:/^[E][M][P][-][0-9]{5}$/', //regex = letra E,M,P,guion y 5 numeros
            // regex= primera mayuscula, letras mayuscvyulas y minusculas y con espacios, se le pone + para decir que la cadena continua
            'nombre'    => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            // regex= primera mayuscula, letras mayuscvyulas y minusculas y con espacios, se le pone + para decir que la cadena continua
            // ejemplo para decimales regex:/^[0-9]+[.][0-]{2}$/
            'apellidos' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            'email'     => 'required|email',
            'telefono'  => 'required|regex:/^[0-9]{10}$/',
            'foto'    => 'image|mimes:png,jpeg,jpg,gif'
        ]);


        $file = $request->file('foto');
        if ($file != "") {
            $img = $file->getClientOriginalName();
            $fecha_act = date('Ymd_His_');
            $img2 = $fecha_act . $img;
            \Storage::disk('local')->put($img2, \File::get($file));
        } else {
            $img2 = 'sin_foto.png';
        }

        $empleado = new empleados;
        $empleado->id_emp         = $request->clave;
        $empleado->nombre         = $request->nombre;
        $empleado->apellidos      = $request->apellidos;
        $empleado->email          = $request->email;
        $empleado->telefono       = $request->telefono;
        $empleado->sexo           = $request->sexo;
        $empleado->descripcion    = $request->desc;
        $empleado->imagen         = $img2;
        $empleado->fk_id_depto    = $request->departamento;
        $empleado->save();

        /* return view('mensaje')
        ->with('proceso','Alta Empleado')
        ->with('mensaje',"El empleado $request->nombre $request->apellidos ha sido dado de alta")
        ->with('error',1); */

        // la funcion session con la clase flash sirve para guardar variables de sesion y mandar datos en estas variables
        // y poder redireccionar hacia una nueva ruta pero ya con las variables de sesion
        Session::flash('mensaje', "El empleado ha sido dado de alta");
        return redirect()->route('consulta_emp');
    }

    public function consulta(){

        $id_usuario = session('sessionid_usu');
        $tipo       = session('sessiontipo');

        if($id_usuario != "" and $tipo != ""){
            // ionstruccion eloquent para remplazar consultas, aqui obtenemos todos los datos de la tb
            //$consulta = empleados::all();
            //instruccion eloquent para realizar joins
            $consulta = empleados::withTrashed()->join('departamentos', 'empleados.fk_id_depto', '=', 'departamentos.id_depto')
                ->select(
                    'empleados.id_emp',
                    'empleados.nombre',
                    'empleados.apellidos',
                    'empleados.email',
                    'empleados.telefono',
                    'departamentos.depto',
                    'empleados.deleted_at',
                    'empleados.imagen'
                )
                ->orderby('empleados.nombre')
                ->get();

            // mostramos los datos
            return view('consulta_empleados')
            ->with('consulta', $consulta)
            ->with('id_usuario',$id_usuario)
            -> with('tipo',$tipo);

        }else{
            Session::flash('mensaje', "Debes loguearse antes de continuar");
            return redirect()->route('iniciar_sesion');
        }
    }

    //para eliminacion logica
    public function desactivar($id_emp){
        //busca el id del empleado
        $empleado = empleados::find($id_emp);
        $empleado->delete(); // lo eliminamos

        // madamos mensaje de eliminacion
        /* return view('mensaje')
        ->with('proceso','Desactivar Empleado')
        ->with('mensaje',"El empleado ha sido desactivado")
        ->with('error',1); */
        Session::flash('mensaje', "El empleado ha sido desactivado");
        return redirect()->route('consulta_emp');
    }

    // para activar el empleado de eliminacion logica
    public function activar($id_emp){
        //para activar el empleado debemos buscarlos que han sido eliminados de forma logica para asi encontrar el id y poderlo restaurar
        $empleado = empleados::withTrashed()->where('id_emp', $id_emp)->restore();

        /* return view('mensaje')
        ->with('proceso','Activar Empleado')
        ->with('mensaje',"El empleado ha sido activado")
        ->with('error',1);; */

        // la funcion session con la clase flash sirve para guardar variables de sesion y mandar datos en estas variables
        // y poder redireccionar hacia una nueva ruta pero ya con las variables de sesion
        Session::flash('mensaje', "El empleado ha sido activado");
        return redirect()->route('consulta_emp');
    }

    // para borrar el empleado de la bd
    public function borrar($id_emp){
        //consultamos la tb nominas
        $nomina = nominas::where('fk_id_emp', $id_emp)->get();

        $cuantos = count($nomina);

        if ($cuantos == 0) {
            //para activar el empleado debemos buscarlos que han sido eliminados de forma logica para asi encontrar el id y poderlo eliminar
            $empleado = empleados::withTrashed()->find($id_emp)->forceDelete();

            /* return view('mensaje')
            ->with('proceso','Borrar Empleado')
            ->with('mensaje',"El empleado ha sido Borrado de la base de datos")
            ->with('error',1); */

            // la funcion session con la clase flash sirve para guardar variables de sesion y mandar datos en estas variables
            // y poder redireccionar hacia una nueva ruta pero ya con las variables de sesion
            Session::flash('mensaje', "El empleado ha sido Borrado de la base de datos");
            return redirect()->route('consulta_emp');
        } else {
            /* return view('mensaje')
            ->with('proceso','Borrar Empleado')
            ->with('mensaje',"No se ha Borrado el empleado de la base de datos ya que tiene registros de nomina")
            ->with('error',0); */

            // la funcion session con la clase flash sirve para guardar variables de sesion y mandar datos en estas variables
            // y poder redireccionar hacia una nueva ruta pero ya con las variables de sesion
            Session::flash('mensaje', "No se ha Borrado el empleado de la base de datos ya que tiene registros de nomina");
            return redirect()->route('consulta_emp');
        }
    }

    public function modificar($id_emp){
        $id_usuario = session('sessionid_usu');
        $tipo       = session('sessiontipo');

        if($id_usuario != "" and $tipo != ""){

            //instruccion eloquent para realizar joins
            $consulta = empleados::withTrashed()->join('departamentos', 'empleados.fk_id_depto', '=', 'departamentos.id_depto')
            ->select(
                'empleados.id_emp',
                'empleados.nombre',
                'empleados.apellidos',
                'empleados.email',
                'empleados.telefono',
                'departamentos.depto',
                'empleados.deleted_at',
                'departamentos.id_depto',
                'empleados.descripcion',
                'empleados.sexo',
                'empleados.imagen'
            )
            ->where('id_emp', $id_emp)
            ->get();

            $deptos = departamentos::all();

            return view('modifica_empleado')
            ->with('consulta', $consulta[0])
            ->with('deptos', $deptos);
        }
    }

    public function actualizar(Request $request){
        // de estamnera se realizan la validaciones
        $this->validate($request, [
            // la validacion regex es para hacer validaciones peronalizadas
            //'clave'     => 'required|regex:/^[E][M][P][-][0-9]{5}$/', //regex = letra E,M,P,guion y 5 numeros
            // regex= primera mayuscula, letras mayuscvyulas y minusculas y con espacios, se le pone + para decir que la cadena continua
            'nombre'    => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            // regex= primera mayuscula, letras mayuscvyulas y minusculas y con espacios, se le pone + para decir que la cadena continua
            // ejemplo para decimales regex:/^[0-9]+[.][0-]{2}$/
            'apellidos' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            'email'     => 'required|email',
            'telefono'  => 'required|regex:/^[0-9]{10}$/',
            'foto'    => 'image|mimes:png,jpeg,jpg,gif'
        ]);


        $file = $request->file('foto');
        if ($file != "") {
            $img = $file->getClientOriginalName();
            $fecha_act = date('Ymd_His_');
            $img2 = $fecha_act . $img;
            \Storage::disk('local')->put($img2, \File::get($file));
        }

        $empleado = empleados::withTrashed()->find($request->clave);
        $empleado->id_emp         = $request->clave;
        $empleado->nombre         = $request->nombre;
        $empleado->apellidos      = $request->apellidos;
        $empleado->email          = $request->email;
        $empleado->telefono       = $request->telefono;
        $empleado->sexo           = $request->sexo;
        $empleado->descripcion    = $request->desc;
        if ($file != "") {
            $empleado->imagen     = $img2;
        }
        $empleado->fk_id_depto    = $request->departamento;
        $empleado->save();

        /* return view('mensaje')
        ->with('proceso','Modifica Empleado')
        ->with('mensaje',"El empleado $request->nombre $request->apellidos ha sido Modificado")
        ->with('error',1); */

        // la funcion session con la clase flash sirve para guardar variables de sesion y mandar datos en estas variables
        // y poder redireccionar hacia una nueva ruta pero ya con las variables de sesion
        Session::flash('mensaje', "El usuario ha sido modificado");
        return redirect()->route('consulta_emp');
    }


    public function salir(){
        return "salir";
    }

    public function mensaje(){
        return "ayudamen";
    }

    public function pago(){
        $dias = 15;
        $pago = 269.36;
        $nomina = ($dias * $pago);

        return "El pago del emplead es: $nomina";
    }


    public function nomina($dias, $pago){
        $nomina = $dias * $pago;
        dd($nomina, $dias, $pago); // sirve para saber que es lo que se obtiene de la variable
        return "El pago de la nomina es: $nomina, por los $dias dias trabajados, con el pado de $pago";
    }



    public function inicio2(){
        return view('inicio2');
    }

    public function inicio($nombre, $dias){
        // return view('empleados',compact('nombre','dias')); // forma 1 de recibir variables de nuestra ruta
        // return view('empleados',['nombre'=>$nombre,'dias'=>$dias]); // forma 2 de recibir una variable de nuestra ruta

        $pago = 100;
        $nomina = $dias * $pago;

        return view('empleados')
            ->with('nombre', $nombre)
            ->with('dias', $dias)
            ->with('nomina', $nomina);
    }
}

<?php

use Illuminate\Support\Facades\Route;
// para hacer referencia a los controladores
use App\Http\Controllers\c_empleados;
use App\Http\Controllers\c_login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// para mandar a llamar funciones desde el controlador
Route::get('mensaje',[c_empleados::class,'mensaje']);
Route::get('pago',[c_empleados::class,'pago']);
Route::get('nomina/{dias}/{pago}',[c_empleados::class,'nomina']);
Route::get('inicio/{nombre}/{dias}',[c_empleados::class,'inicio']);
Route::get('salir',[c_empleados::class,'salir'])->name('salir_pagina');

// para la creacion de un sistema
Route::get('inicio2',[c_empleados::class,'inicio2'])->name('inicio2');
Route::get('alta_empleado',[c_empleados::class,'alta_empleado'])->name('alta_empleado');
Route::post('guarda_emp',[c_empleados::class,'guarda_emp'])->name('guarda_emp');
Route::get('consulta_emp',[c_empleados::class,'consulta'])->name('consulta_emp');
Route::get('desactivar_emp/{id_emp}',[c_empleados::class,'desactivar'])->name('desactivar_emp');
Route::get('activar_emp/{id_emp}',[c_empleados::class,'activar'])->name('activar_emp');
Route::get('borrar_emp/{id_emp}',[c_empleados::class,'borrar'])->name('borrar_emp');
Route::get('modificar_emp/{id_emp}',[c_empleados::class,'modificar'])->name('modificar_emp');
Route::post('actualiza_emp',[c_empleados::class,'actualizar'])->name('actualiza_emp');

// para iniicar sesion
Route::get('iniciar_sesion',[c_login::class,'login'])->name('iniciar_sesion');
Route::post('valida_sesion',[c_login::class,'valida_sesion'])->name('valida_sesion');
Route::get('principal',[c_login::class,'principal'])->name('principal');
Route::get('cerrar_sesion',[c_login::class,'cerrar_sesion'])->name('cerrar_sesion');

// pruebas de rutas
/* Route::get('/', function () {
    return view('welcome');
}); */


/* Route::get('/ruta1', function () {
    return "Hola mundo :)";
});


Route::get('/arearec', function () {
    $base = 4;
    $altura = 10;
    $area = $base * $altura;

    return $area;
});


Route::get('/arearec2', function () {
    $base = 4;
    $altura = 10;
    $area = $base * $altura;

    return "El area del rectangulo es: $area con base: $base y altura: $altura";
});


Route::get('/arearec3/{base}/{altura}', function ($base, $altura) {
    $area = $base * $altura;

    return "El area del rectangulo es: $area con base: $base y altura: $altura";
});



Route::get('/arearec3/{base}/{altura}', function ($base, $altura) {
    $area = $base * $altura;

    return "El area del rectangulo es: $area con base: $base y altura: $altura";
});


Route::get('/nomina1/{diast}/{pagosd?}', function ($diast, $pagosd=null) {
    if($pagosd == null){
        $pagosd = 100;
        $nomina = $diast * $pagosd;
    }else{
        $nomina = $diast * $pagosd;
    }

    echo "Dias trabajados: $diast <br>";
    echo "Pago nomina: $pagosd <br>";
    echo "Total Pago: $nomina";
});


Route::get('/redirect', function () {
    return redirect('ruta1');
});

Route::redirect('redirect2','ruta1');

Route::redirect('redirect3','arearec3/7/6');

Route::get('/redirect4/{base}/{altura}', function ($base,$altura) {
    return redirect("arearec3/$base/$altura");
});

Route::redirect('redirect5','https://www.google.com.mx');
 */

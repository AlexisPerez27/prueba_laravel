<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados',function(Blueprint $table){
            $table -> increments('id_emp');
            $table -> string('nombre',40);
            $table -> string('apellidos',40);
            $table -> string('email',40);
            $table -> decimal('telefono',15,0);
            $table -> string('sexo',1);
            $table -> string('descripcion',200);
            $table -> integer('edad');
            $table -> decimal('salario',10,3);
            $table -> string('descripcion',255);

            $table -> integer('fk_id_depto') -> unsigned();
            $table -> foreign('fk_id_depto') -> references('id_depto') -> on('departamentos');


            $table -> rememberToken();
            $table -> timestamps();
            // nota del admin: el campo deleted_at crearlo directamente en la base de datos

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empleados');
    }
}

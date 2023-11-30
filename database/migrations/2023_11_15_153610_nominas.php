<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nominas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas',function(Blueprint $table){
            $table -> increments('id_nomina');
            $table -> dateTime('fecha');
            $table -> double('monto',10,3);
            $table -> integer('diast');

            $table -> integer('fk_id_emp') -> unsigned();
            $table -> foreign('fk_id_emp') -> references('id_emp') -> on('empleados');

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
        Schema::drop('nominas');
    }
}

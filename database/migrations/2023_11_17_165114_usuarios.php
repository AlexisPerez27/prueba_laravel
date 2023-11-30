<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios',function(Blueprint $table){
            $table -> increments('id_usuario');
            $table -> string('nombre',40);
            $table -> string('apellidos',40);
            $table -> string('email',40);
            $table -> string('pass',255);
            $table -> string('tipo',10);
            $table -> string('activo',2);
            $table -> rememberToken();
            $table -> timestamps();
            // nota del admin: el campo deleted_at crearlo directamente en la base de datos
            // para correr una migración en especifico
            // php artisan migrate --path=/database/migrations/my_migration.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Departamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos',function(Blueprint $table){
            $table -> increments('id_depto');
            $table -> string('depto',40);
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
        Schema::drop('departamentos');
    }
}

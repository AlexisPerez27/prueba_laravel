<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class empleados extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = "id_emp";
    protected $fillabel = ['id_emp','nombre','apellidos','email','telefono','sexo','edad','salario','descripcion','imagen','fk_id_depto'];
}

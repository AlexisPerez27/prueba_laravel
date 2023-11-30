<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nominas extends Model
{
    use HasFactory;

    protected $primaryKey = "id_nomina";
    protected $fillabel = ['id_nomina','fecha','monto','dias_trabajados','fk_id_empleados'];
}

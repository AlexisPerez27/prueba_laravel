<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;
    protected $primaryKey = "id_usuario";
    protected $fillabel = ['id_usuario','nombre','apellidos','email','pass','tipo','activo'];
}

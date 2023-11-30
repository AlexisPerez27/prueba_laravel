<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departamentos extends Model
{
    use HasFactory;

    protected $primaryKey = "id_depto";
    protected $fillabel = ['id_depto','depto'];


}

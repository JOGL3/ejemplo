<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'emp_id';
    public $timestamps = false;
    protected $fillable = [
        'emp_dni',
        'emp_apellidos',
        'emp_nombres',
        'emp_sexo',
        'emp_telefono',
        'emp_email',
        'emp_usuario'
    ];
    protected $guarded = [];

}

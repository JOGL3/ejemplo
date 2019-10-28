<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'pac_id';
    public $timestamps = false;
    protected $fillable = [
        'pac_dni',
        'pac_apellidos',
        'pac_nombres',
        'pac_sexo',
        'pac_direccion',
        'pac_fechnac',
        'pac_telefono',
        'pac_email',
        'pac_estado'
    ];
    protected $guarded = [];
}

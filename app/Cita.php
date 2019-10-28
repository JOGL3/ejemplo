<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'cit_id';
    public $timestamps = false;
    protected $fillable = [
        'cit_idpaciente',
        'cit_idempleado',
        'cit_idespec',
        'cit_fecha',
        'cit_hora',
        'cit_estado'
    ];
    protected $guarded = [];
}

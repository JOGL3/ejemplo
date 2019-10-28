<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialidadMedico extends Model
{
    protected $table = 'especialidad_medico';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'emp_id',
        'esp_id'
    ];
    protected $guarded = [];
}

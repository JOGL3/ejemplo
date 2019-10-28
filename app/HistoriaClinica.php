<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    protected $table = 'historiasclinicas';
    protected $primaryKey = 'hc_id';
    public $timestamps = false;
    protected $fillable = [
      'hc_idpaciente' ,
      'hc_idcitamed' ,
      'hc_idcie10' ,
      'hc_alergias' ,
      'hc_hta' ,
      'hc_dm' ,
      'hc_anamnesis' ,
      'hc_pa' ,
      'hc_fc' ,
      'hc_t' ,
      'hc_fr' ,
      'hc_peso' ,
      'hc_aspectogeneral' ,
      'hc_estadoconciencia' ,
      'hc_piel' ,
      'hc_cabeza' ,
      'hc_cuello' ,
      'hc_torax' ,
      'hc_cardiovascular' ,
      'hc_abdomen' ,
      'hc_genitouriano' ,
      'hc_osteomuscular' ,
      'hc_neurologico' ,
      'hc_diagnostico' ,
      'hc_tratamiento' ,
      'hc_ss1' ,
      'hc_dc1' ,
      'hc_res1' ,
      'hc_ss2' ,
      'hc_dc2' ,
      'hc_res2' ,
      'hc_ss3' ,
      'hc_dc3' ,
      'hc_res3'
    ];
    protected $guarded = [];

}

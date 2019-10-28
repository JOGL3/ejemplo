<?php
  function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia = date("d") - $dia;
    if ($dia_diferencia < 0 && $mes_diferencia <= 0)
    $ano_diferencia--;
    return $ano_diferencia;
  }
?>
@extends('plantilla.plantilla')
@section('contenido')
<section id="filiacion" class="mb-4">
  <div class="row">
      <div class="col-xl-12">
          <label>1. FILIACIÓN:</label>
      </div>
  </div>
  <div class="container">
      <div class="form-group row">
          <input type="text" name="hc_idpaciente" hidden value="{{$pac->pac_id}}">
          <label class="col-xl-1 col-form-label">Nombre:</label>
          <div class="col-xl-8">
              <input type="text" readonly class="form-control" value="{{$pac->pac_apellidos.', '.$pac->pac_nombres}}">
          </div>
          <label class="col-xl-1 col-form-label">Teléf:</label>
          <div class="col-xl-2">
              <input type="text" readonly class="form-control" value="{{$pac->pac_telefono}}">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-xl-1 col-form-label">Edad:</label>
          <div class="col-xl-2">
              <input type="text" readonly class="form-control" value="<?php echo calculaedad ($pac->pac_fechnac); ?>">
          </div>
          <label class="col-xl-3 col-form-label">Fecha de Nacimiento:</label>
          <div class="col-xl-6">
              <input type="text" readonly class="form-control" value="{{$pac->pac_fechnac}}">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-xl-1 col-form-label">Domicilio:</label>
          <div class="col-xl-11">
              <input type="text" readonly class="form-control" value="{{$pac->pac_direccion}}">
          </div>
      </div>
  </div>
</section>
  @foreach($historiasclinicas as $hc)
  <div class="mb-4">
      <h1>N° Historia Clinica: {{$hc->hc_id}}</h1>
  </div>
  <div>
      <div class="container">
          <div class="form-group row">
              <label class="col-xl-1 col-form-label">N° Cita:</label>
              <div class="col-xl-3">
                  <input type="text" readonly class="form-control" name="hc_idcitamed" value="{{$hc->cit_id}}">
              </div>
              <label class="col-xl-1 col-form-label">Fecha:</label>
              <div class="col-xl-3">
                  <input type="text" readonly class="form-control" value="{{$hc->cit_fecha}}">
              </div>
              <label class="col-xl-1 col-form-label">Hora:</label>
              <div class="col-xl-3">
                  <input type="text" readonly class="form-control" value="{{$hc->cit_hora}}">
              </div>
          </div>
      </div>
      <section id="antecedentes">
          <div class="row">
              <div class="col-xl-2">
                  <label>2. ANTECEDENTES:</label>
              </div>
              <div class="col-xl-3">
                  <div class="checkbox">
                      <label><input type="checkbox" > ALERGIAS</label>
                  </div>
                  <input type="text" value="{{$hc->hc_alergias}}" class="form-control" readonly>
              </div>
              <div class="col-xl-3">
                  <div class="checkbox">
                      <label><input type="checkbox" > HTA</label>
                  </div>
                  <input type="text" value="{{$hc->hc_hta}}" class="form-control" readonly>
              </div>
              <div class="col-xl-3">
                  <div class="checkbox">
                      <label><input type="checkbox" > DM</label>
                  </div>
                  <input type="text" value="{{$hc->hc_dm}}" class="form-control" readonly>
              </div>
          </div>
      </section>
      <section id="anamnesis">
          <div class="row mt-3">
              <div class="col-xl-2">
                  <label>3. ANAMNESIS:</label>
              </div>
              <div class="col-xl-9">
                  <textarea class="form-control"  rows="3" readonly style="resize: none;">{{$hc->hc_anamnesis}}</textarea>
              </div>
          </div>
      </section>
      <section id="examenclinico">
          <div class="row mt-3">
              <div class="col-xl-12">
                  <label>4. EXAMEN CLÍNICO:</label>
              </div>
              <div class="container">
                  <div class="form-group row">
                      <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">PA:</p></label>
                      <div class="col-xl-2 col-md-2 col-sm-2">
                          <input type="text" readonly value="{{$hc->hc_pa}}" class="form-control" >
                      </div>
                      <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">FC:</p></label>
                      <div class="col-xl-1 col-md-2 col-sm-2">
                          <input type="text" readonly value="{{$hc->hc_fc}}" class="form-control" >
                      </div>
                      <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">T°:</p></label>
                      <div class="col-xl-1 col-md-2 col-sm-2">
                          <input type="text" readonly value="{{$hc->hc_t}}" class="form-control" >
                      </div>
                      <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">FR:</p></label>
                      <div class="col-xl-1 col-md-2 col-sm-2">
                          <input type="text" readonly value="{{$hc->hc_fr}}" class="form-control" >
                      </div>
                      <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">PESO:</p></label>
                      <div class="col-xl-2 col-md-2 col-sm-2">
                          <input type="text" readonly value="{{$hc->hc_peso}}" class="form-control" >
                      </div>
                  </div>
              </div>
          </div>
          <div class="container">
              <div class="form-group row">
                  <label class="col-xl-3 col-form-label">Aspecto General</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_aspectogeneral}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Estado de Conciencia</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_estadoconciencia}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Piel</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_piel}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Cabeza</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_cabeza}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Cuello</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_cuello}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Tórax</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_torax}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Cardiovascular</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_cardiovascular}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Abdomen</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_abdomen}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Genitourinario</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_genitouriano}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Osteomuscular</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_osteomuscular}}" class="form-control" >
                  </div>
                  <label class="col-xl-3 col-form-label">Neurológico</label>
                  <div class="col-xl-9">
                      <input type="text" readonly value="{{$hc->hc_neurologico}}" class="form-control" >
                  </div>
              </div>
          </div>
          <div class="container">
              <div class="row mt-3">
                  <div class="col-xl-4">
                      <label>EXÁMENES AUXLILIARES</label>
                      <table class="table table-sm">
                          <tr>
                              <td>SS.</td>
                              <td> <input type="text" readonly value="{{$hc->hc_ss1}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>D/C</td>
                              <td> <input type="text" readonly value="{{$hc->hc_dc1}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>Res.</td>
                              <td> <input type="text" readonly value="{{$hc->hc_res1}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>SS.</td>
                              <td> <input type="text" readonly value="{{$hc->hc_ss2}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>D/C</td>
                              <td> <input type="text" readonly value="{{$hc->hc_dc2}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>Res.</td>
                              <td> <input type="text" readonly value="{{$hc->hc_res2}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>SS.</td>
                              <td> <input type="text" readonly value="{{$hc->hc_ss3}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>D/C</td>
                              <td> <input type="text" readonly value="{{$hc->hc_dc3}}" class="form-control"> </td>
                          </tr>
                          <tr>
                              <td>Res.</td>
                              <td> <input type="text" readonly value="{{$hc->hc_res3}}" class="form-control"> </td>
                          </tr>
                      </table>
                  </div>
                  <div class="col-xl-8">
                      <div class="form-group">
                          <label><p class="text-center" style="text-decoration: underline;" >DIAGNÓSTICO (Dx)</p></label>
                          <textarea class="form-control" readonly name="hc_diagnostico" rows="7" style="resize: none;">{{$hc->hc_diagnostico}}</textarea>
                      </div>
                      <div class="form-group">
                          <label><p class="text-center" style="text-decoration: underline;" >TRATAMIENTO (Rp)</p></label>
                          <textarea class="form-control" readonly name="hc_tratamiento" rows="7" style="resize: none;">{{$hc->hc_tratamiento}}</textarea>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
  @endforeach
@endsection

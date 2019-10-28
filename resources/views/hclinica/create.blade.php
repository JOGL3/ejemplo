<?php
      function calculaedad($fechanacimiento){
        $fecha_nacimiento = new DateTime($fechanacimiento);
        $hoy = new DateTime();
        $annos = $hoy->diff($fecha_nacimiento);
        return $annos->y;
      }
?>
@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <h1>Historia Clinica</h1>
    @if (count($errors)>0)
      <div class="alert alert-danger">
        <p>Corregir los siguientes campos:</p>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
</div>
<form action="{{url('historiaclinica')}}" method="post">
  {{ csrf_field() }}
  @method('POST')
    <div class="container">
        <div class="form-group row">
            <label class="col-xl-1 col-form-label">N° Cita:</label>
            <div class="col-xl-3">
                <input type="text" readonly class="form-control" name="hc_idcitamed" value="{{$cita->cit_id}}">
            </div>
            <label class="col-xl-1 col-form-label">Fecha:</label>
            <div class="col-xl-3">
                <input type="text" readonly class="form-control" value="{{$cita->cit_fecha}}">
            </div>
            <label class="col-xl-1 col-form-label">Hora:</label>
            <div class="col-xl-3">
                <input type="text" readonly class="form-control" value="{{$cita->cit_hora}}">
            </div>
        </div>
    </div>
    <section id="filiacion">
      <div class="row">
          <div class="col-xl-12">
              <label>1. FILIACIÓN:</label>
          </div>
      </div>
      <div class="container">
          <div class="form-group row">
              <input type="text" name="hc_idpaciente" hidden value="{{$cita->cit_idpaciente}}">
              <label class="col-xl-1 col-form-label">Nombre:</label>
              <div class="col-xl-8">
                  <input type="text" readonly class="form-control" value="{{$cita->pac_apellidos.', '.$cita->pac_nombres}}">
              </div>
              <label class="col-xl-1 col-form-label">Teléf:</label>
              <div class="col-xl-2">
                  <input type="text" readonly class="form-control" value="{{$cita->pac_telefono}}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-xl-1 col-form-label">Edad:</label>
              <div class="col-xl-2">
                  <input type="text" readonly class="form-control" value="<?php echo calculaedad ($cita->pac_fechnac); ?>">
              </div>
              <label class="col-xl-3 col-form-label">Fecha de Nacimiento:</label>
              <div class="col-xl-6">
                  <input type="text" readonly class="form-control" value="{{$cita->pac_fechnac}}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-xl-1 col-form-label">Domicilio:</label>
              <div class="col-xl-11">
                  <input type="text" readonly class="form-control" value="{{$cita->pac_direccion}}">
              </div>
          </div>
      </div>
    </section>
    <section id="antecedentes">
        <div class="row">
            <div class="col-xl-2">
                <label>2. ANTECEDENTES:</label>
            </div>
            <div class="col-xl-3">
                <div class="checkbox">
                    <label><input type="checkbox" id="chbxalergias" onChange="validarchk1();"> ALERGIAS</label>
                </div>
                <input type="text" name="hc_alergias" class="form-control" id="inpalergias" readonly>
            </div>
            <div class="col-xl-3">
                <div class="checkbox">
                    <label><input type="checkbox" id="chbxhta" onChange="validarchk2();"> HTA</label>
                </div>
                <input type="text" name="hc_hta" class="form-control" id="inphta" readonly>
            </div>
            <div class="col-xl-3">
                <div class="checkbox">
                    <label><input type="checkbox" id="chbxdm" onChange="validarchk3();"> DM</label>
                </div>
                <input type="text" name="hc_dm" class="form-control" id="inpdm" readonly>
            </div>
        </div>
    </section>
    <section id="anamnesis">
        <div class="row mt-3">
            <div class="col-xl-2">
                <label>3. ANAMNESIS:</label>
            </div>
            <div class="col-xl-9">
                <textarea class="form-control" name="hc_anamnesis" rows="3" style="resize: none;"></textarea>
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
                        <input type="text" name="hc_pa" class="form-control" >
                    </div>
                    <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">FC:</p></label>
                    <div class="col-xl-1 col-md-2 col-sm-2">
                        <input type="text" name="hc_fc" class="form-control" >
                    </div>
                    <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">T°:</p></label>
                    <div class="col-xl-1 col-md-2 col-sm-2">
                        <input type="text" name="hc_t" class="form-control" >
                    </div>
                    <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">FR:</p></label>
                    <div class="col-xl-1 col-md-2 col-sm-2">
                        <input type="text" name="hc_fr" class="form-control" >
                    </div>
                    <label class="col-xl-1 col-md-1 col-sm-1 col-form-label"><p class="text-right">PESO:</p></label>
                    <div class="col-xl-2 col-md-2 col-sm-2">
                        <input type="text" name="hc_peso" class="form-control" >
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label">Aspecto General</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_aspectogeneral" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Estado de Conciencia</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_estadoconciencia" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Piel</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_piel" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Cabeza</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_cabeza" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Cuello</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_cuello" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Tórax</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_torax" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Cardiovascular</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_cardiovascular" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Abdomen</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_abdomen" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Genitourinario</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_genitouriano" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Osteomuscular</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_osteomuscular" class="form-control" >
                </div>
                <label class="col-xl-3 col-form-label">Neurológico</label>
                <div class="col-xl-9">
                    <input type="text" name="hc_neurologico" class="form-control" >
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
                            <td> <input type="text" name="hc_ss1" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>D/C</td>
                            <td> <input type="text" name="hc_dc1" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>Res.</td>
                            <td> <input type="text" name="hc_res1" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>SS.</td>
                            <td> <input type="text" name="hc_ss2" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>D/C</td>
                            <td> <input type="text" name="hc_dc2" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>Res.</td>
                            <td> <input type="text" name="hc_res2" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>SS.</td>
                            <td> <input type="text" name="hc_ss3" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>D/C</td>
                            <td> <input type="text" name="hc_dc3" class="form-control"> </td>
                        </tr>
                        <tr>
                            <td>Res.</td>
                            <td> <input type="text" name="hc_res3" class="form-control"> </td>
                        </tr>
                    </table>
                </div>
                <div class="col-xl-8">
                    <div class="form-group">
                        <label><p class="text-center" style="text-decoration: underline;" >DIAGNÓSTICO (Dx)</p></label>
                        <textarea class="form-control" name="hc_diagnostico" rows="7" style="resize: none;"></textarea>
                    </div>
                    <div class="form-group">
                        <label><p class="text-center" style="text-decoration: underline;" >TRATAMIENTO (Rp)</p></label>
                        <textarea class="form-control" name="hc_tratamiento" rows="7" style="resize: none;"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
      <div class="form-group row">
          <label class="col-xl-1 col-form-label">CIE 10:</label>
          <div class="col-xl-8">
            <select name="hc_idcie10" class="form-control" required>
                <option value="" hidden>--- Seleccione ---</option>
                @foreach($cie10 as $c10)
                    <option value="{{$c10->id10}}">{{$c10->id10.' - '.$c10->dec10}}</option>
                @endforeach
            </select>
          </div>
      </div>
    </div>
    <div class="row my-4">
        <div class="col text-center">
            <input type="submit" class="btn btn-primary" value="Guardar Historia Clínica">
            <a href="{{url('cita')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
    function validarchk1(){
        var chk = document.getElementById('chbxalergias');
        var txt = document.getElementById('inpalergias');
        if(chk.checked){
            $("#inpalergias").prop("readonly", false);
        }else{
            txt.value='';
            $("#inpalergias").prop("readonly", true);
        }
    }
    function validarchk2(){
        var chk = document.getElementById('chbxhta');
        var txt = document.getElementById('inphta');
        if(chk.checked){
            $("#inphta").prop("readonly", false);
        }else{
            txt.value='';
            $("#inphta").prop("readonly", true);
        }
    }
    function validarchk3(){
        var chk = document.getElementById('chbxdm');
        var txt = document.getElementById('inpdm');
        if(chk.checked){
            $("#inpdm").prop("readonly", false);
        }else{
            txt.value='';
            $("#inpdm").prop("readonly", true);
        }
    }
</script>
@endsection

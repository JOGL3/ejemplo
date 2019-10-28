@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <h1>Programar Cita Médica</h1>
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
<form action="{{url('cita')}}" method="post">
  @method('POST')
  {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group">
                <label>Paciente *</label>
                <select name="cit_idpaciente" class="form-control selectpicker" data-live-search="true" required>
                  <option value="cit_idpaciente" hidden>--- Seleccione ---</option>
                  @foreach($pacientes as $pac)
                    <option value="{{$pac->pac_id}}">{{$pac->pac_dni.' - '.$pac->pac_apellidos.', '.$pac->pac_nombres}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label>Fecha *</label>
                <input type="date" name="cit_fecha" value="<?php echo date('Y-m-d'); ?>" class="form-control" required readonly>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label>Hora *</label>
                <input type="time" name="cit_hora" class="form-control" min="08:00:00" max="19:00:00" required>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label>Especialidad *</label>
                <select name="cit_idespec" id="select-especialidad" class="form-control selectpicker" data-live-search="true" required>
                    <option value="" hidden>--- Seleccione ---</option>
                    @foreach($especialidades as $esp)
                      <option value="{{$esp->esp_id}}">{{$esp->esp_nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="form-group">
                <label>Médico *</label>
                <select name="cit_idempleado" id="select-medico" class="form-control" required>
                    <option value="" hidden>--- Seleccione ---</option>
                </select>
            </div>
        </div>
        <div class="col-xl-12 my-4">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Programar">
                <a href="{{url('cita')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>
@endsection

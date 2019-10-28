@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <h1>Modificar Paciente</h1>
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
<form action="{{url('paciente/'.$pac->pac_id)}}" method="POST" class="my-3">
    @method('PATCH')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-2 col-md-6">
            <div class="form-group">
                <label for="">DNI *</label>
                <input type="text" name="pac_dni" id="txtdni" class="form-control" required maxlength="8" minlength="8" value="{{$pac->pac_dni}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Apellidos *</label>
                <input type="text" name="pac_apellidos" id="txtapellidos" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{$pac->pac_apellidos}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Nombres *</label>
                <input type="text" name="pac_nombres" id="txtnombres" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{$pac->pac_nombres}}" readonly>
            </div>
        </div>
        <div class="col-xl-12 col-md-6">
            <div class="form-group">
                <label for="">Direccion</label>
                <input type="text" name="pac_direccion" maxlength="70" class="form-control" value="{{$pac->pac_direccion}}" >
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Sexo *</label>
                <select name="pac_sexo" class="form-control" required>
                  @foreach ($sex as $sexo)
                    @if ($sexo->sexo_id == $pac->pac_sexo)
                    <option value="{{$sexo->sexo_id}}" selected>{{$sexo->sexo_nombre}}</option>
                    @else
                    <option value="{{$sexo->sexo_id}}">{{$sexo->sexo_nombre}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Fecha de Nacimiento *</label>
                <input type="date" name="pac_fechnac" class="form-control" required value="{{$pac->pac_fechnac}}" >
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Teléfono</label>
                <input type="text" name="pac_telefono" class="form-control" maxlength="13" value="{{$pac->pac_telefono}}" >
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="email" name="pac_email" class="form-control" value="{{$pac->pac_email}}" >
            </div>
        </div>
        <div class="col-xl-12 my-4">
            <div class="form-group">
                <input type="submit" value="Modificar" class="btn btn-warning">
                <a href="{{url('paciente')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>
@endsection

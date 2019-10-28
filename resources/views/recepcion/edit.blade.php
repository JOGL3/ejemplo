{{$recep->emp_apelidos}}@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <h1>Modificar Empleado</h1>
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
<form action="{{url('recep/'.$recep->emp_id)}}" method="POST" class="my-3">
    @method('PATCH')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-2 col-md-6">
            <div class="form-group">
                <label for="">DNI *</label>
                <input type="text" name="emp_dni" id="txtdni" class="form-control" required maxlength="8" minlength="8" value="{{$recep->emp_dni}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Apellidos *</label>
                <input type="text" name="emp_apellidos" id="txtapellidos" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{$recep->emp_apellidos}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Nombres *</label>
                <input type="text" name="emp_nombres" id="txtnombres" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{$recep->emp_nombres}}" readonly>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Sexo *</label>
                <select name="emp_sexo" class="form-control" required>
                  @foreach ($sexo as $sex)
                    @if ($sex->sexo_id == $recep->emp_sexo)
                    <option value="{{$sex->sexo_id}}" selected>{{$sex->sexo_nombre}}</option>
                    @else
                    <option value="{{$sex->sexo_id}}">{{$sex->sexo_nombre}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Teléfono</label>
                <input type="text" name="emp_telefono" class="form-control" maxlength="13" value="{{$recep->emp_telefono}}" >
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="email" name="emp_email" class="form-control" value="{{$recep->emp_email}}" >
            </div>
        </div>
        <div class="col-xl-12 my-4">
            <div class="form-group">
                <input type="submit" value="Modificar" class="btn btn-warning">
                <a href="{{url('recep')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>
@endsection

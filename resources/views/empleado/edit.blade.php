@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <div class="row">
        <div class="col-xl-6">
            <h3>Editar Empleados</h3>
        </div>
        <div class="col-xl-6">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>
</div>
<form action="{{url('empleado/'.$emp->emp_id)}}" method="POST" class="my-3">
    @method('PATCH')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-2 col-md-6">
            <div class="form-group">
                <label for="">DNI *</label>
                <input type="text" name="emp_dni" id="txtdni" class="form-control" required maxlength="8" minlength="8" value="{{$emp->emp_dni}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Apellidos *</label>
                <input type="text" name="emp_apellidos" id="txtapellidos" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{$emp->emp_apellidos}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Nombres *</label>
                <input type="text" name="emp_nombres" id="txtnombres" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{$emp->emp_nombres}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Cargo *</label>
                <select name="role_id" id="" class="form-control" required>
                    @foreach ($roles as $rol)
                        @if ($rol->id == $emp->role_id)
                        <option value="{{$rol->id}}" selected>{{$rol->descripcion}}</option>
                        @else
                        <option value="{{$rol->id}}">{{$rol->descripcion}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-12 my-4">
            <div class="form-group">
                <input type="submit" value="Modificar" class="btn btn-warning">
                <a href="{{url('empleado')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>
@endsection
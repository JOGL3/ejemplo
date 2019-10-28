@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <div class="row">
        <div class="col-xl-6">
            <h3>Planilla de Empleados</h3>
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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pacientes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>DNI</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Cargo</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach($empleados as $emp)
                    <tr>
                        <td>{{$emp->emp_dni}}</td>
                        <td>{{$emp->emp_apellidos}}</td>
                        <td>{{$emp->emp_nombres}}</td>
                        <td>{{$emp->descripcion}}</td>
                        <td>       
                            <a href="{{url('empleado/'.$emp->emp_id.'/edit')}}" class="btn btn-sm btn-warning">Editar</a>                  
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
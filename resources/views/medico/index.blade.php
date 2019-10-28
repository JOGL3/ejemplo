@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <div class="row">
        <div class="col-xl-6">
            <a href="{{url('medico/create')}}" class="btn btn-primary">Registrar Médico</a>
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
        <h6 class="m-0 font-weight-bold text-primary">Planilla de Médicos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>DNI</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Sexo</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                  @foreach($medicos as $med)
                    <tr>
                        <td>{{$med->emp_dni}}</td>
                        <td>{{$med->emp_apellidos}}</td>
                        <td>{{$med->emp_nombres}}</td>
                        <td>{{$med->sexo_nombre}}</td>
                        <td>
                            <a href="{{url('medico/'.$med->emp_id.'/edit')}}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

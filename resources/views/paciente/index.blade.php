@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <div class="row">
        <div class="col-xl-6">
            <a href="{{url('paciente/create')}}" class="btn btn-primary">Registrar Tesis</a>
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
        <h6 class="m-0 font-weight-bold text-primary">Tesis</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Codigo</th>
                    <th>Filial</th>
                    <th>Escuela</th>
                    <th>Tipo Correlativo</th>
                    <th>Año Correlativo</th>
                    <th>Glosa Correlativo</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach($pacientes as $pac)
                    <tr>
                        <td>{{$pac->pac_dni}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$pac->pac_apellidos}}</td>
                        <td>{{$pac->pac_nombres}}</td>
                        <td>{{$pac->sexo_nombre}}</td>
                        <td>
                            <a data-toggle="modal" data-target="#modal-info-{{$pac->pac_id}}" class="btn btn-secondary btn-sm" href="">Ver</a>
                            @include('paciente.detalles')
                            <a href="{{url('hc/'.$pac->pac_id)}}" target="_blank" class="btn btn-info btn-sm">HC</a>
                            <a href="{{url('paciente/'.$pac->pac_id.'/edit')}}" class="btn btn-warning btn-sm">Editar</a>
                            <a data-toggle="modal" data-target="#modal-delete-{{$pac->pac_id}}" class="btn btn-danger btn-sm" href="">Eliminar</a>
                            @include('paciente.delete')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('plantilla.plantilla')
@section('contenido')
@if(Auth::user()->hasrole('recep'))
<div class="mb-4">
    <div class="row">
        <div class="col-xl-6">
            <a href="{{url('cita/create')}}" class="btn btn-primary">Programar Cita</a>
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
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Citas Médicas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Paciente</th>
                    <th>Especialidad</th>
                    @if(Auth::user()->hasAnyRole(['admin','recep']))
                    <th>Médico</th>
                    @endif
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                  @foreach($citas as $c)
                    <tr>
                        <td>{{$c->pac_dni.' - '.$c->pac_apellidos.', '.$c->pac_nombres}}</td>
                        <td>{{$c->esp_nombre}}</td>
                        @if(Auth::user()->hasAnyRole(['admin','recep']))
                        <td>{{$c->emp_apellidos.', '.$c->emp_nombres}}</td>
                        @endif
                        <td>{{$c->cit_fecha}}</td>
                        <td>{{$c->cit_hora}}</td>
                        <td>
                            @if ($c->cit_estado === 1)
                                <span class="badge badge-success">{{ $c->ec_nombre }}</span>
                            @elseif($c->cit_estado === 2)
                                <span class="badge badge-secondary">{{ $c->ec_nombre }}</span>
                            @else
                                <span class="badge badge-danger">{{ $c->ec_nombre }}</span>
                            @endif
                        </td>
                        <td>
                            @if(Auth::user()->hasrole('med'))
                              @if($c->cit_estado === 2)
                                <a href="{{url('newhistoriaclinica/'.$c->cit_id)}}" class="btn btn-sm btn-light btn-outline-dark">Atender</a>
                              @endif
                            @endif
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

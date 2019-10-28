@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <div class="row">
        <div class="col-xl-6"></div>
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
        <h6 class="m-0 font-weight-bold text-primary">Historias Clínicas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Paciente</th>
                    <th>N° HC</th>
                    <th>Especialidad</th>
                    <th>Fecha</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                  @foreach($historiasclinicas as $hc)
                    <tr>
                        <td>{{$hc->pac_dni.' - '.$hc->pac_apellidos.', '.$hc->pac_nombres}}</td>
                        <td>{{$hc->hc_id}}</td>
                        <td>{{$hc->esp_nombre}}</td>
                        <td>{{$hc->cit_fecha}}</td>
                        <td>
                            <a  data-toggle="modal" data-target="#modal-info-{{$hc->hc_id}}" class="btn btn-info btn-sm" href="">Ver</a>
                            @include('hclinica.info')
                            <a href="{{url('hclinica/pdf/'.$hc->hc_id)}}" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i></a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

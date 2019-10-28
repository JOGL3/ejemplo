<div class="modal fade" id="modal-info-{{$hc->hc_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-tittle">N° Historia Clínica: {{$hc->hc_id}}</h5>
      </div>
      <div class="modal-body">
        <label class="form-control">Paciente: {{$hc->pac_dni.' - '.$hc->pac_apellidos.', '.$hc->pac_nombres}}</label>
        <label class="form-control">Especialidad: {{$hc->esp_nombre}}</label>
        <label class="form-control">Fecha: {{$hc->cit_fecha}}</label>
        <label class="form-control">Hora: {{$hc->cit_hora}}</label>
        <label class="form-control">Médico: {{$hc->emp_apellidos.', '.$hc->emp_nombres}}</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

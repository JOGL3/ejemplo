<div class="modal fade" id="modal-info-{{$recep->emp_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-tittle">Información del Trabajador</h5>
      </div>
      <div class="modal-body">
        <label class="form-control">DNI: {{$recep->emp_dni}}</label>
        <label class="form-control">Apellidos: {{$recep->emp_apellidos}}</label>
        <label class="form-control">Nombres: {{$recep->emp_nombres}}</label>
        <label class="form-control">Sexo: {{$recep->sexo_nombre}}</label>
        <label class="form-control">Teléfono: {{$recep->emp_telefono}}</label>
        <label class="form-control">E-mail: {{$recep->emp_email}}</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

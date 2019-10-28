<div class="modal fade" id="modal-info-{{$pac->pac_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-tittle">Información del Paciente</h5>
      </div>
      <div class="modal-body">
        <label class="form-control">DNI: {{$pac->pac_dni}}</label>
        <label class="form-control">Apellidos: {{$pac->pac_apellidos}}</label>
        <label class="form-control">Nombres: {{$pac->pac_nombres}}</label>
        <label class="form-control">Sexo: {{$pac->sexo_nombre}}</label>
        <label class="form-control">Dirección: {{$pac->pac_direccion}}</label>
        <label class="form-control">Fecha Nacimiento: {{$pac->pac_fechnac}}</label>
        <label class="form-control">Teléfono: {{$pac->pac_telefono}}</label>
        <label class="form-control">E-mail: {{$pac->pac_email}}</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

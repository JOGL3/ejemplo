<div class="modal fade" id="modal-delete-{{$pac->pac_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p class="lead">¿Deseas eliminar a este paciente?</p>
      </div>
      <div class="modal-footer">
        <form action="{{url('paciente/'.$pac->pac_id)}}" method="post">
          {{csrf_field()}}
          @method('DELETE')
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
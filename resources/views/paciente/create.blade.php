@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <h1>Registro</h1>
    @if (count($errors)>0)
      <div class="alert alert-danger">
        <p>Corregir los siguientes campos:</p>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
</div>

<form action="{{url('paciente')}}" method="POST" class="my-3">
    @method('POST')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-2 col-md-6">
            <div class="form-group">
                <label for="">Codigo*</label>
                <input type="text" name="pac_dni" id="txtdni" class="form-control" required maxlength="8" minlength="8" value="{{old('pac_dni')}}">
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Numero*</label>
                <input type="text" name="pac_apellidos" id="txtapellidos" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{old('pac_apellidos')}}">
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="form-group">
                <label for="">Año</label>
                <input type="text" name="pac_direccion" maxlength="50" class="form-control" value="{{old('pac_direccion')}}" >
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Glosas*</label>
                <input type="text" name="pac_apellidos" id="txtapellidos" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{old('pac_apellidos')}}">
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Tipo de Correlativo*</label>
                <select name="emp_sexo" class="form-control" required>
                  <option value="" hidden>Seleccione Tipo de Correlativo</option>
                  <option value="1" @if (old('emp_sexo') == "1") {{ 'selected' }} @endif>Correlativo Resoluciones</option>
                  <option value="2" @if (old('emp_sexo') == "2") {{ 'selected' }} @endif>Corelativo Dictamen</option>
                  <option value="3" @if (old('emp_sexo') == "3") {{ 'selected' }} @endif>Corelativo Solicitud Grado</option>
                  <option value="4" @if (old('emp_sexo') == "4") {{ 'selected' }} @endif>Corelativo Autorización de Publicación</option>
                </select>
            </div>
        </div>
        <div class="col-xl-12 my-4">
            <div class="form-group">
                <input type="submit" value="Registrar" class="btn btn-primary">
                <a href="{{url('paciente')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#btnbuscar').click(function(){
            var numdni=$('#dni').val();
            if (numdni!='') {
                $.ajax({
                    url:"{{ route('consultar.reniec') }}",
                    method:'GET',
                    data:{dni:numdni},
                    dataType:'json',
                    success:function(data){
                        var resultados=data.estado;
                        if (resultados==true) {
                            $('#txtdni').val(data.dni);
                            $('#txtnombres').val(data.nombres);
                            $('#txtapellidos').val(data.apellidos);
                        }else{
                            $('#txtdni').val('');
                            $('#txtnombres').val('');
                            $('#txtapellidos').val('');
                            $('#mensaje').show();
                            $('#mensaje').delay(2000).hide(2500);
                        }
                    }
                });
            }else{
                alert('Escribir el DNI');
                $('#dni').focus();
            }
        });
    });
</script>
@endsection

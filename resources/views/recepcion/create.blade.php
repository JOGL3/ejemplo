@extends('plantilla.plantilla')
@section('contenido')
<div class="mb-4">
    <h1>Registrar Empleado</h1>
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
<div class="row">
    <div class="col-xl-2">
        <input type="text" id="dni" class="form-control" placeholder="Escriba el DNI" maxlength="8" minlength="8" autofocus>
    </div>
    <div class="col-xl-2">
        <button id="btnbuscar" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
    </div>
    <div class="col-xl-4">
        <label id="mensaje" style="color: red;display: none;font-size: 12pt;">El numero de DNI no es valido.</label>
    </div>
</div>
<form action="{{url('recep')}}" method="POST" class="my-3">
    @method('POST')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-2 col-md-6">
            <div class="form-group">
                <label for="">DNI *</label>
                <input type="text" name="emp_dni" id="txtdni" class="form-control" required maxlength="8" minlength="8" value="{{old('emp_dni')}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Apellidos *</label>
                <input type="text" name="emp_apellidos" id="txtapellidos" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{old('emp_apellidos')}}" readonly>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="form-group">
                <label for="">Nombres *</label>
                <input type="text" name="emp_nombres" id="txtnombres" class="form-control" maxlength="50" required style="text-transform:uppercase;" value="{{old('emp_nombres')}}" readonly>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Sexo *</label>
                <select name="emp_sexo" class="form-control" required>
                  <option value="" hidden>--- Seleccione ---</option>
                  <option value="1" @if (old('emp_sexo') == "1") {{ 'selected' }} @endif>Femenino</option>
                  <option value="2" @if (old('emp_sexo') == "2") {{ 'selected' }} @endif>Masculino</option>
                </select>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">Teléfono</label>
                <input type="text" name="emp_telefono" class="form-control" maxlength="13" value="{{old('emp_telefono')}}" >
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="email" name="emp_email" class="form-control" value="{{old('emp_email')}}" >
            </div>
        </div>
        <div class="col-xl-12 my-4">
            <div class="form-group">
                <input type="submit" value="Registrar" class="btn btn-primary">
                <a href="{{url('recep')}}" class="btn btn-danger">Cancelar</a>
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

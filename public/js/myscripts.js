$(function(){
  $('#select-especialidad').on('change', buscarMedico);
});

function buscarMedico() {
  var idespec = $(this).val();
  if(! idespec){
    $('#select-medico').html('<option value="" hidden>--- Seleccione ---</option>');
  }

  //AJAX
  $.get('../api/especialidad/'+idespec+'/medico', function (data) {
    var html_select = '<option value="" hidden>--- Seleccione ---</option>';
    for (var i=0; i<data.length; i++)
      html_select += '<option value="'+data[i].emp_id+'">'+data[i].emp_apellidos+', '+data[i].emp_nombres+'</option>';
    $('#select-medico').html(html_select);
  });
}

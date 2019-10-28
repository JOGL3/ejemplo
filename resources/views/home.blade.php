<?php
  $nro_pacientes = DB::table('pacientes')->count();
  $nro_citas = DB::table('citas')->count();
  $nro_empleados = DB::table('empleados')->count();
  $nro_especialidades = DB::table('especialidades')->count();
  $mydatos = DB::table('empleados')
              ->join('role_user','role_user.user_id','empleados.emp_dni')
              ->join('roles','roles.id','role_user.role_id')
              ->where('empleados.emp_dni','=',Auth::user()->usuario)->first();
  $nro_citas_atendidas = DB::table('citas')->where('cit_estado','=','1')->count();
  $nro_citas_programadas = DB::table('citas')->where('cit_estado','=','2')->count();
  $citas_abril = DB::table('citas')->whereMonth('cit_fecha','=','4')->count();
  $citas_mayo = DB::table('citas')->whereMonth('cit_fecha','=','5')->count();
  $citas_junio = DB::table('citas')->whereMonth('cit_fecha','=','6')->count();
  $citas_julio = DB::table('citas')->whereMonth('cit_fecha','=','7')->count();
  $citas_agosto = DB::table('citas')->whereMonth('cit_fecha','=','8')->count();
  $citas_septiembre = DB::table('citas')->whereMonth('cit_fecha','=','9')->count();
?>
@extends('plantilla.plantilla')
@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Bienvenido: {{$mydatos->emp_apellidos.', '.$mydatos->emp_nombres}}</h1>
  <h2 class="h3 mb-0 text-gray-800">Cargo: {{$mydatos->descripcion}}</h2>
</div>
<div class="row">
    @if(Auth::user()->hasrole('admin'))
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs text-primary text-uppercase mb-1">Documentos</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nro_pacientes}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs text-primary text-uppercase mb-1">Documentos generados</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nro_citas}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs text-primary text-uppercase mb-1">Resoluciones</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nro_especialidades}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-hospital fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs text-primary text-uppercase mb-1">Empleados</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nro_empleados}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-folder fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Documentos generados</h6>
        </div>
        <div class="card-body">
          <div class="chart-bar">
            <canvas id="myBarChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Documentos generados</h6>
        </div>
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Generados correctamente
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-secondary"></i> Documentos por concluir
            </span>
          </div>
        </div>
      </div>
    </div>

    @endif
</div>
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{asset('plantilla/vendor/chart.js/Chart.min.js')}}"></script>
<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Atendidas", "Programadas"],
      datasets: [{
        data: [<?php echo $nro_citas_atendidas; ?>, <?php echo $nro_citas_programadas; ?>],
        backgroundColor: ['#1cc88a', '#858796']
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>
<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }

  // Bar Chart Example
  var ctx = document.getElementById("myBarChart");
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Abril", "Mayo", "Junio","Julio","Agosto","Septiembre"],
      datasets: [{
        label: "Citas:",
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: [ <?php echo $citas_abril; ?>, 
                <?php echo $citas_mayo; ?>, 
                <?php echo $citas_junio; ?>, 
                <?php echo $citas_julio; ?>, 
                <?php echo $citas_agosto; ?>, 
                <?php echo $citas_septiembre; ?>],
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 60,
            maxTicksLimit: 5,
            padding: 10
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10
      },
    }
  });
</script>
@endsection
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sistema de gestión de documentos</title>
        <link rel="shortcut icon" href="{{asset('img/ucv.png')}}">

        <!-- Custom fonts for this template -->
        <link href="{{asset('plantilla/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{asset('plantilla/css/sb-admin-2.min.css')}}" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="{{asset('plantilla/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

        <!-- Select-Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a href="{{route('home')}}" class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon">
                      <img src="{{asset('img/ucv.png')}}">
                      <p > Universidad Cesar Vallejo S.A.C </p>
                    </div>
                    
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-1">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{url('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoa" aria-expanded="true" aria-controls="collapseTwoa">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mantenimiento</span>
                  </a>
                  <div id="collapseTwoa" class="collapse" aria-labelledby="headingTwoa" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Tesis:</h6>
                      <a class="collapse-item" href="{{url('paciente')}}">Registro de Tesis</a>
                     
                    </div>
                  </div>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="{{url('cita')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Registros</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Talento Humano</span>
                  </a>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Planilla:</h6>
                      <a class="collapse-item" href="{{url('empleado')}}">Empleados</a>
                    </div>
                  </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                @if(Auth::user()->hasrole('admin'))
                <!-- Nav Item - Pages Collapse Menu -->
               

                <!-- Divider -->
                <hr class="sidebar-divider">
                @endif

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="btn" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('contenido')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <a href="https://github.com/JOGL3/ProyectosPracticas" target="_blank">Sistemas-Practica-ucv</a> 2019</span>
                    </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('plantilla/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('plantilla/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('plantilla/js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{asset('plantilla/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plantilla/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('plantilla/js/demo/datatables-demo.js')}}"></script>

        <!-- Select-Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

        <script src="{{asset('js/myscripts.js')}}"></script>

        @yield('scripts')

    </body>
</html>

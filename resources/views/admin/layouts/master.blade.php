<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('') }}dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Pengaturan Akun</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.index') }}" class="brand-link">
                <img src="{{ asset('') }}dist/img/assets/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SMK AB International</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('admin.index') }}" class="d-block">&ensp;{{ Auth::user()->email }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon far fa-fw fa-user"></i>
                                <p>Data PPDB<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('dataSiswa.index') }}" class="nav-link">
                                        &ensp;<p>Data Siswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <br>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @yield('content-header')
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('main-content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                @yield('aside')
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer text-center">
            <strong>Copyright &copy; <span id="date"></span> <a href="/">SMK AB International School</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('') }}dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('') }}dist/js/demo.js"></script>

    <!-- REQUIRED SCRIPTS -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $(function () {
            $('#province').on('change', function () {
                $.ajax({
                    url: "{{ route('dependent.city') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $(this).val()
                    },
                    success: function (data) {
                        $('#city').empty();
                        var a = Object.values(data);
                        console.log(a);
                        a.forEach(data => {
                            $('#city').append('<option>'+data+'</option>');
                        });
                    }
                });
            });
        });

        function clockTick()    {
            currentTime = new Date();
            year = currentTime.getFullYear();
            document.getElementById('date').innerHTML=year;
        }
        setInterval(function(){clockTick();}, 1000);
    </script>
    
</body>
</html>

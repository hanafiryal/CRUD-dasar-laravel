
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? '' }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE-3.1.0/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('admin.layouts.navbar')

  @include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.layouts.header')

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Alert Success -->
        @if($success = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          {{ $success }}
        </div>
        @endif
        <!-- End Alert Success -->

        <!-- Alert Warning -->
        @if($warning = Session::get('warning'))
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          {{ $warning }}
        </div>
        @endif
        <!-- End Alert Warning -->

        <!-- Alert Danger -->
        @if($danger = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          {{ $danger }}
        </div>
        @endif
        <!-- End Alert Danger -->
        
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  @include('admin.layouts.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/AdminLTE-3.1.0/dist/js/adminlte.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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

  // Add active class and stay opened when selected
  var url = '<?php echo url()->current(); ?>';

  // Sidebar menu entirely but not cover treeview
  $('ul.nav-sidebar a').filter(function(){
    return this.href == url;
  }).addClass('active');

  // Treeview
  $('ul.nav-treeview a').filter(function(){
    return this.href == url;
  }).parentsUntil(".nav-item .has-treeview").addClass('menu-open').prev('a').addClass('active');
</script>
</body>
</html>
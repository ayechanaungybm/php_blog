<?php
session_start();
require "../config/config.php";
if(empty($_SESSION['user_id']) && empty($_SESSION['loggedin'])){
  header("Location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Widgets</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <section class="content-header">
      <div class="container-fluid">
            <h1 style="text-align:center">Blog Sites</h1>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-4">

         <div class="card card-widget">
           <div class="card-header">
            <div style="text-align:center !important;float:none;"class="card-title">
              <h2 >Blog Title</h2>
            </div>

           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">
           </div>
           <!-- /.card-body -->

         </div>
         <!-- /.card -->
       </div>
       <div class="col-md-4">

         <div class="card card-widget">
           <div class="card-header">
            <div style="text-align:center !important;float:none;"class="card-title">
              <h2 >Blog Title</h2>
            </div>

           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">
           </div>
           <!-- /.card-body -->

         </div>
         <!-- /.card -->
       </div>
       <div class="col-md-4">

         <div class="card card-widget">
           <div class="card-header">
            <div style="text-align:center !important;float:none;"class="card-title">
              <h2 >Blog Title</h2>
            </div>

           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">
           </div>
           <!-- /.card-body -->

         </div>
         <!-- /.card -->
       </div>

     </div>
     <div class="row">
      <div class="col-md-4">

        <div class="card card-widget">
          <div class="card-header">
           <div style="text-align:center !important;float:none;"class="card-title">
             <h2 >Blog Title</h2>
           </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-4">

        <div class="card card-widget">
          <div class="card-header">
           <div style="text-align:center !important;float:none;"class="card-title">
             <h2 >Blog Title</h2>
           </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-4">

        <div class="card card-widget">
          <div class="card-header">
           <div style="text-align:center !important;float:none;"class="card-title">
             <h2 >Blog Title</h2>
           </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>

    </div>
    </section>


  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left:0">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>

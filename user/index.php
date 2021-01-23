<?php
session_start();
require "../config/config.php";
if(empty($_SESSION['user_id']) && empty($_SESSION['loggedin'])){
  header("Location:login.php");
}

$stmt=$pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
$stmt->execute();
$result=$stmt->fetchAll();
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

        <?php
        if($result){
        foreach ($result as  $value) {?>
          <div class="col-md-4">
              <div class="card card-widget">
              <div class="card-header">
               <div style="text-align:left !important;float:none;"class="card-title">
                 <h4><?php
                 if(strlen($value['title'])>=35){
                      echo substr($value['title'],0,35);?>
                      <a href="blogdetail.php?id=<?php echo $value['id'];?>">....</a><?php
                 }else{
                      echo $value['title'];
                 }

                 ?>
               </h5>
               </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <a href="blogdetail.php?id=<?php echo $value['id'];?>"><img class="img-fluid pad" src="../admin/images/<?php echo $value['image']?>"style="display:block; margin-left:auto; margin-right:auto; width:100%; height:300px; !important;"></a>

              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
        <?php }
        }?>

      </div>


    </section>


  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left:0">
    <div class="float-right d-none d-sm-block">
      <a href="logout.php" type="button" class="btn btn-default">Logout</a>
      
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

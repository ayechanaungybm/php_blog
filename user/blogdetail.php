<?php
// I think your apache is disabling the debugging errors.
// Please add the 3 lines to display errors.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require "../config/config.php";
if(empty($_SESSION['user_id']) && empty($_SESSION['loggedin'])){
  header("Location:login.php");
}
$blog_id=$_GET['id'];

$stmt=$pdo->prepare("SELECT * FROM posts WHERE id=".$blog_id);
$stmt->execute();
$result=$stmt->fetchAll();

$stmtcmt=$pdo->prepare("SELECT * FROM comments WHERE post_id=".$blog_id);
$stmtcmt->execute();
$cmtResult=$stmtcmt->fetchAll();

if($cmtResult){
  foreach ($cmtResult as $key => $value) {
    //echo $key;
    $author_id=$cmtResult[$key]['author_id'];
    $stmtau=$pdo->prepare("SELECT * FROM users WHERE id=".$author_id);
    $stmtau->execute();
    $auResult[]=$stmtau->fetchAll();
  }

}
// echo "<pre>";
// print_r($auResult);

if($_POST){

    if(empty($_POST['comment'])){
      $cmtError="Comment are not to allowed.";
    }else{
      $comment=$_POST['comment'];
      $stmt=$pdo->prepare("INSERT INTO comments(content,author_id,post_id) VALUES (:content,:author_id,:post_id)");
      $result=$stmt->execute(
        array(':content'=>$comment,':author_id'=>$_SESSION['user_id'],"post_id"=>$blog_id)
      );
      if($result){
        header("Location:blogdetail.php?id=".$blog_id);
      }
    }


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
       <div class="col-md-12">
         <!-- Box Comment -->
         <div class="card card-widget">
           <div class="card-header">

              <div style="text-align:center !important;float:none;"class="card-title">
                <h4><?php echo $result[0]['title']?></h4>

             </div>
             <!-- /.card-tools -->
           </div>
           <!-- /.card-header -->
           <div class="card-body">
            <img class="img-fluid pad" src="../admin/images/<?php echo $result[0]['image']?>"style="display:block; margin-left:auto; margin-right:auto; width:90%; height:70%; !important;">
            <br>
             <p><h5><?php echo $result[0]['content']?></h5></p>
             <h6>Comments</h6><hr>
              <a href="index.php" type="button" class="btn btn-default">Back</a>
           </div>

           <!-- /.card-body -->

             <div class="card-footer card-comments">
              <div class="card-comment">
                <!-- User image -->
                <?php foreach ($cmtResult as $key => $value){?>
                  <div class="comment-text" style="margin-left:0px !important">
                    <span class="username">
                       <?php echo $auResult[$key][0]['name'];?>
                      <span class="text-muted float-right"><?php echo $cmtResult[0]['created_at'];?></span>
                    </span><!-- /.username -->
                       <?php echo $cmtResult[0]['content'];?>
                  </div>
              <?php  } ?>



                <!-- /.comment-text -->
              </div>
              </div>

           <!-- /.card-footer -->
           <div class="card-footer">
             <form action="" method="post">
               <!-- .img-push is used to add margin to elements next to floating images -->
               <div class="img-push">
                 <p style="color:red"><?php echo empty($cmtError)  ? '':'*'.$cmtError;?></p>
                 <input type="text" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
               </div>
             </form>
           </div>
           <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       </div>
       <!-- /.col -->

     </div>
    </section>

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
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

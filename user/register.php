<?php

require '../config/config.php';
require "../config/common.php";
if($_POST){
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || strlen($_POST['password'])<4) {
    if(empty($_POST['name'])){
      $nameError="Name required";
    }
    if(empty($_POST['email'])){
      $emailError="Email required";
    }
    if(empty($_POST['password'])){
      $pwError="Password required";
    }
    else if(strlen($_POST['password'])<4){
      $pwError="Password must be 4 characters at least.";
    }
  }else{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
  $stmt=$pdo->prepare("SELECT * FROM users WHERE email=:email");
  $stmt->bindValue(":email",$email);
  $stmt->execute();
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  if($result){
    echo "<script>alert('Email duplicated');</script>";

  }else{
    $stmt=$pdo->prepare("INSERT INTO users(name,email,password) VALUES(:name,:email,:password)");
    $result=$stmt->execute(
      array(":name"=>$name,
            ":email"=>$email,
            ":password"=>$password)
    );
    if($result){
      echo "<script>alert('Successfully register!');window.location.href='login.php';</script>";
    }
  }

}
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blog | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Blog</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
          <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>">
        <p style="color:red"><?php echo empty($nameError)  ? '':'*'.$nameError;?></p>
        <div class="input-group mb-3">

          <input type="text" class="form-control" name="name" placeholder="Name" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-circle"></span>
            </div>
          </div>
        </div>
        <p style="color:red"><?php echo empty($emailError)  ? '':'*'.$emailError;?></p>
        <div class="input-group mb-3">

          <input type="email" class="form-control" name="email" placeholder="Email" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <p style="color:red"><?php echo empty($pwError)  ? '':'*'.$pwError;?></p>
        <div class="input-group mb-3">

          <input type="password" class="form-control" name="password" placeholder="Password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary block btn-block">Register</button>
        <a type="button" href="login.php" class="btn btn-block btn-default">Login</a>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>

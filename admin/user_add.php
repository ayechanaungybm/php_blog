<?php
session_start();
require "../config/config.php";
if(empty($_SESSION['user_id']) && empty($_SESSION['loggedin'])){
  header("Location:login.php");
}
if($_SESSION['role']!=1){ // if not admin role, back to login
    header('Location:login.php');
  }
if($_POST){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
  $role=(!empty($_POST['role']))?1:0;

  $stmt=$pdo->prepare("SELECT * FROM users WHERE email=:email");
  $stmt->bindValue(':email',$email);
  $stmt->execute();
  $result=$stmt->fetch(PDO::FETCH_ASSOC);

  if($result){
      echo("<script>alert('Email already existed.');</script>");
  }else{
    $stmt=$pdo->prepare("INSERT INTO users(name,email,password,role) VALUES(:name,:email,:password,:role)");
    $result=$stmt->execute(
      array(':name'=>$name,':email'=>$email,':password'=>$password,':role'=>$role)

    );

    if($result){
      echo("<script>alert('Succesfully added.');window.location.href='user_list.php'</script>");
    }
  }


}
?>
<?php
    include('header.php');
 ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form class="" action="user_add.php" method="post">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <textarea name="email" class="form-control" rows="8" cols="80" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control" name="password" value="" required>

                    </div>
                    <div class="form-group">
                        <label for="">Admin</label><br>
                        <input type="checkbox" name="role" value="1">

                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-success" name="" value="SUBMIT">
                      <a href="index.php" class="btn btn-warning">Back</a>
                    </div>
                </form>
              </div>

            </div>
            <!-- /.card -->


          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <?php
        include('footer.html');
     ?>

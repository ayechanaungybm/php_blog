<?php
session_start();
require "../config/config.php";
require "../config/common.php";
if(empty($_SESSION['user_id']) && empty($_SESSION['loggedin'])){
  header("Location:login.php");
}
if($_SESSION['role']!=1){ // if not admin role, back to login
    header('Location:login.php');
}
if($_POST){
  if (empty($_POST['title']) || empty($_POST['content']) || empty($_FILES['image']['name'])) {
    if(empty($_POST['title'])){
      $titleError="Title required";
    }
    if(empty($_POST['content'])){
      $contentError="Content required";
    }
    if(empty($_FILES['image']['name'])){
      $imageError="Image required";
    }
  }else{
    $file='images/'.($_FILES['image']['name']);

    $image_type=pathinfo($file,PATHINFO_EXTENSION);

    if($image_type!='png' && $image_type!='jpg' && $image_type!='jpeg'){
      echo "<script>alert('Image must be png,jpg,jpeg');</script>";
    }else{
      $title=$_POST['title'];
      $content=$_POST['content'];
      $image=$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'],$file);
      $stmt=$pdo->prepare("INSERT INTO posts(title,content,image,author_id) VALUES (:title,:content,:image,:author_id)");
      $result=$stmt->execute(
        array(':title'=>$title,':content'=>$content,':image'=>$image,':author_id'=>$_SESSION['user_id'])
      );
      if($result){
        echo "<script>alert('Succesfully added');window.location.href='index.php';</script>";

      }
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
                <form class="" action="add.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>">
                    <div class="form-group">
                        <label for="">Title</label><p style="color:red"><?php echo empty($titleError)  ? '':'*'.$titleError;?></p>
                        <input type="text" class="form-control" name="title" value="" >
                    </div>
                    <div class="form-group">
                        <label for="">Content</label><p style="color:red"><?php echo empty($contentError)  ? '':'*'.$contentError; ?></p>
                        <textarea name="content" class="form-control" rows="8" cols="80" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label><p style="color:red"><?php echo empty($imageError) ? '':'*'.$imageError;?></p>
                        <input type="file" name="image" >
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

<?php
session_start();
require "../config/config.php";
require "../config/common.php";
if(empty($_SESSION['user_id']) && empty($_SESSION['loggedin'])){
  header("Location:login.php");
}

if($_SESSION['role']!=1){
  header("Location:login.php");
}

if (!empty($_POST['search'])) {
  setcookie('search',$_POST['search'], time() + (86400 * 30), "/");
}else{
  if (empty($_GET['pageno'])) {
    unset($_COOKIE['search']);
    setcookie('search', null, -1, '/');
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
              <div class="card-header">
                <h3 class="card-title">Blog Lists</h3>
              </div>
              <!-- /.card-header -->
              <?php
                if(!empty($_GET['pageno'])){
                  $pageno=$_GET['pageno'];
                }else{
                  $pageno=1;
                }
                $numOfrecs=1;
                $offset=($pageno-1)*$numOfrecs;

                // if(empty($_POST['search'])){
                //   $stmt=$pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
                //   $stmt->execute();
                //   $rawResult=$stmt->fetchAll();
                //
                //   $total_page=ceil(count($rawResult)/$numOfrecs);
                //
                //   $stmt=$pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numOfrecs");
                //   $stmt->execute();
                //   $result=$stmt->fetchAll();
                //
                // }else{
                //
                //     $searchKey=$_POST['search'];
                //     $stmt=$pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
                //     $stmt->execute();
                //     $rawResult=$stmt->fetchAll();
                //
                //     $total_page=ceil(count($rawResult)/$numOfrecs);
                //
                //     $stmt=$pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
                //     $stmt->execute();
                //     $result=$stmt->fetchAll();
                //
                //   }
                if (empty($_POST['search']) && empty($_COOKIE['search'])) {
                $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
                $stmt->execute();
                $rawResult = $stmt->fetchAll();
                $total_page = ceil(count($rawResult) / $numOfrecs);

                $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numOfrecs");
                $stmt->execute();
                $result = $stmt->fetchAll();
                 }else{
                    $searchKey = (!empty($_POST['search']))? $_POST['search'] : $_COOKIE['search'];
                    $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    $total_page = ceil(count($result) / $numOfrecs);

                    $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                 }

               ?>
              <div class="card-body">

                <div>
                  <a href="add.php" type="button" class="btn btn-success">Created New</a>
                </div>
                <br>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th style="width: 40px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($result){
                      $i=1;
                        foreach($result as $value){


                    ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo escape($value['title'])?></td>
                          <td><?php echo escape(substr($value['content'],0,50))?></td>
                          <td>
                            <div class="btn-group">
                              <div class="container">
                                    <a href="edit.php?id=<?php echo $value['id']?>" type="button" class="btn btn-warning">Edit</a>
                              </div>
                              <div class="container">
                                  <a href="delete.php?id=<?php echo $value['id']?>"
                                    onclick="return confirm('Are you sure want to delete this item')" type="button" class="btn btn-danger">Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                    <?php
                    $i++;
                  }
                }
                ?>


                  </tbody>
                </table><br>
                <nav aria-label="Page navigation example" style="float:right">
                  <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                    <li class="page-item <?php if($pageno<=1){ echo 'disabled';}?>">
                      <a class="page-link" href="<?php if($pageno<=1){echo '#';}else{echo '?pageno='.($pageno-1);}?>">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                    <li class="page-item <?php if($pageno>=$total_page){echo 'disabled';}?>">
                      <a class="page-link" href="<?php if($pageno>=$total_page){echo '#';}else{echo '?pageno='.($pageno+1);}?>">Next</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_page;?>">Last</a></li>
                  </ul>
                </nav>
              </div>
              <!-- /.card-body -->

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

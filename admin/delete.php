<?php
require '../config/config.php';

if($_SESSION['role']!=1){ // if not admin role, back to login
    header('Location:login.php');
  }
$stmt=$pdo->prepare("DELETE FROM posts WHERE id=".$_GET['id']);
$stmt->execute();

header('location:index.php');
 ?>

<?php

session_start();

if (!isset($_SESSION['username'])) {
  header('location:login.php');
}

include 'dbcon.php';

$id = $_GET['id'];

$query = " delete from list where taskid = '$id' ";

if (mysqli_query($con, $query)) {
  ?>
  <div class="alert alert-success text-center" role="alert">
    Congratulations. Task completed successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
    header('Location: ../home.php');
}else{
  ?>
  <div class="alert alert-danger text-center" role="alert">
    Error! Try again!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
    header('Location: ../home.php');
}


 ?>

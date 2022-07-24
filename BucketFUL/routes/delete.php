<?php

session_start();

if (!isset($_SESSION['username'])) {
  header('location:login.php');
}

include 'dbcon.php';

$id = $_GET['id'];

$query = " update list set deleted = 1 where taskid = '$id' ";

if (mysqli_query($con, $query)) {
  header('Location: ../home.php');
  ?>
  <div class="alert alert-success text-center" role="alert">
    Task deleted successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php

}else{
  header('Location: ../home.php');
  ?>
  <div class="alert alert-danger text-center" role="alert">
    Error! Unable to delete task!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
}


 ?>

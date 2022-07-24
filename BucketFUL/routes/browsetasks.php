<?php

session_start();

if (!isset($_SESSION['username'])) {
  header('location:login.php');
}

include 'dbcon.php';

$userid = $_SESSION["id"];
$task_search = " select * from list where id = '$userid' and status = 0 and deleted = 0 ";
$query = mysqli_query($con, $task_search);

$taskcount = mysqli_num_rows($query);

//add tasks
if (isset($_POST['submit'])) {
  $taskname = $_POST['taskname'];
  $category = strtolower($_POST['category']);
  $additional = $_POST['additional'];


  $t=time();
  $date = date("Y-m-d",$t);
  $insertquery = " insert into list(id, taskname, category, status, deleted, additional, date) values('$userid', '$taskname', '$category', '$status', 0, '$additional', '$date') ";
  $iquery = mysqli_query($con, $insertquery);

if ($iquery) {
  ?>
  <div class="alert alert-success text-center" role="alert">
    Task added successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
    header('Location: ../home.php');
}

}

?><!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="BucketFUL | A web-application to track all your bucket lists">
      <meta name="author" content="kv">
      <title>BucketFUL | Home</title>
      <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
      <link rel="stylesheet" href="../css/sb-admin-2.css">
  </head>

  <body id="page-top"> <!-- c,nc,t -->

      <!-- Page Wrapper -->
      <div id="wrapper">

          <!-- Sidebar -->
          <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

              <!-- Sidebar - Brand -->
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-hat-wizard"></i>
                </div>
                  <div class="sidebar-brand-text mx-3">BucketFUL</div>
              </a>

              <!-- Divider -->
              <hr class="sidebar-divider my-0">

              <!-- Nav Item - Dashboard -->
              <li class="nav-item">
                  <a class="nav-link" href="../home.php">
                      <i class="fas fa-fw fa-tachometer-alt"></i>
                      <span>Dashboard</span></a>
              </li>

              <!-- Divider -->
              <hr class="sidebar-divider">

              <!-- Heading -->
              <div class="sidebar-heading">
                  Explore
              </div>

              <!-- Nav Item - Pages Collapse Menu -->
              <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                      aria-expanded="true" aria-controls="collapseTwo">
                      <i class="fas fa-fw fa-cog"></i>
                      <span>Browse</span>
                  </a>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                          <a class="collapse-item" href="browsecategories.php">Browse by categories</a>
                          <a class="collapse-item active" href="browsetasks.php">Browse by tasks</a>
                      </div>
                  </div>
              </li>

              <!-- Nav Item - Utilities Collapse Menu -->
              <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                      aria-expanded="true" aria-controls="collapseUtilities">
                      <i class="fas fa-fw fa-wrench"></i>
                      <span>Archive</span>
                  </a>
                  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                      data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <a class="collapse-item" href="completed.php">Completed</a>
                          <a class="collapse-item" href="bin.php">Bin</a>
                      </div>
                  </div>
              </li>

              <!-- Divider -->
              <hr class="sidebar-divider">

              <!-- Sidebar Toggler (Sidebar) -->
              <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
              </div>

          </ul>
          <!-- End of Sidebar -->

          <!-- Content Wrapper -->
          <div id="content-wrapper" class="d-flex flex-column">

              <!-- Main Content -->
              <div id="content">

                  <!-- Topbar -->
                  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                      <!-- Sidebar Toggle (Topbar) -->
                      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                          <i class="fa fa-bars"></i>
                      </button>

                      <!-- Topbar Search -->
                      <form
                          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                          <div class="input-group">
                              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for friends..."
                                  aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                  <button class="btn btn-primary" type="button">
                                      <i class="fas fa-search fa-sm"></i>
                                  </button>
                              </div>
                          </div>
                      </form>

                      <!-- Topbar Navbar -->
                      <ul class="navbar-nav ml-auto">

                          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                          <li class="nav-item dropdown no-arrow d-sm-none">
                              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-search fa-fw"></i>
                              </a>
                              <!-- Dropdown - Messages -->
                              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                  aria-labelledby="searchDropdown">
                                  <form class="form-inline mr-auto w-100 navbar-search">
                                      <div class="input-group">
                                          <input type="text" class="form-control bg-light border-0 small"
                                              placeholder="Search for friends..." aria-label="Search"
                                              aria-describedby="basic-addon2">
                                          <div class="input-group-append">
                                              <button class="btn btn-primary" type="button">
                                                  <i class="fas fa-search fa-sm"></i>
                                              </button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </li>

                          <!-- Nav Item - User Information -->

                          <li class="nav-item">
                              <a class="nav-link" href="#" id="userDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#TaskModal">  <i class="fas fa-plus fa-sm"></i><span class="mr-2 d-none d-lg-inline text-gray-100 small"> Create new task</span>
                                  </button>
                              </a>

                          <li class="nav-item dropdown no-arrow">
                              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['username']; ?> </span>
                                  <img class="img-profile rounded-circle"
                                      src="../img/undraw_profile.svg">
                              </a>
                              <!-- Dropdown - User Information -->
                              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                  aria-labelledby="userDropdown">
                                  <a class="dropdown-item" href="#">
                                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Profile
                                  </a>
                                  <a class="dropdown-item" href="#">
                                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Settings
                                  </a>
                                  <a class="dropdown-item" href="#">
                                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Activity Log
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Logout
                                  </a>
                              </div>
                          </li>

                      </ul>

                  </nav>
                  <!-- End of Topbar -->

                  <!-- Begin Page Content -->
                  <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Browse by Tasks</h1>
                    <p class="mb-6">All your tasks can be found here.</p>

                    <?php

                    if (!$taskcount) {
                      // you dont have any list. start by creating one
                      ?>

                      <div class="text-center">
                          <p class="lead text-gray-800 mb-4 sad">(⌣̩̩́_⌣̩̩̀)</p>
                          <p class="lead text-gray-800 mb-5">Oops...No Tasks Found</p>
                          <p class="text-gray-500 mb-0">Well, don't worry. We got you covered, better late than never.</p>
                          <a href="" data-toggle="modal" data-target="#TaskModal">Get started by creating a new task</a>
                      </div>

                    <?php
                    }else{
                      // normal flow
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Completed Tasks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                      <tr>
                                          <th>Task Name</th>
                                          <th>Category</th>
                                          <th>Additional Info</th>
                                          <th>Date added</th>
                                          <th>Options</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while($row = mysqli_fetch_assoc($query)) {
                                      ?>
                                        <tr>
                                          <td> <?php echo strtoupper( $row['taskname']); ?> </td>
                                            <td> <?php echo strtoupper($row['category']); ?> </td>
                                              <td> <?php echo strtoupper($row['additional']); ?> </td>
                                                <td> <?php echo $row['date']; ?> </td>
                                                <td>
                                                  <button class="btn btn-success btn-circle btn-sm" onclick="getTaskId(<?php echo (int) $row['taskid']; ?>)" type="button" data-toggle="modal" data-target="#CompleteModal">

                                                        <i class="fas fa-check"></i>
                                                  </button>

                                                  <button class="btn btn-danger btn-circle btn-sm" onclick="getTaskId(<?php echo (int) $row['taskid']; ?>)" type="button" data-toggle="modal" data-target="#DeleteModal">

                                                        <i class="fas fa-trash"></i>
                                                  </button>
                                                </td>
                                        </tr>
                                      <?php }
                                     ?>

                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                  <?php } ?>



                  </div>
                  <!-- /. end container-fluid -->

              </div>
              <!-- End of Main Content -->

              <!-- Footer -->
              <footer class="sticky-footer bg-white">
                  <div class="container my-auto">
                      <div class="copyright text-center my-auto">
                          <span>Copyright &copy; BucketFUL 2022</span>
                      </div>
                  </div>
              </footer>
              <!-- End of Footer -->

          </div>
          <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Leaving so early? </h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">Are you sure you want to end your current session.</div>
                  <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-primary" href="../logout.php">Logout</a>
                  </div>
              </div>
          </div>
      </div>

      <!-- New task Modal -->
      <div class="modal fade" id="TaskModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">New task</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form class="form mr-auto" action=" <?php echo htmlentities($_SERVER['PHP_SELF']); ?> " method="post">
                  <div class="input-group">
                      <input type="text" class="form-control bg-might small" placeholder="Task name" name="taskname"  autocomplete="off" required>
                  </div> <br>
                  <div class="input-group">
                      <input type="text" class="form-control bg-might small" placeholder="Category" name="category"  autocomplete="off" required>
                  </div><br>
                  <div class="input-group">
                      <input type="text" class="form-control bg-might small" placeholder="Additional info...(links, dates, people etc)"  autocomplete="off" name="additional">
                  </div> <br>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-success">Create</button></form>
            </div>
        </div>
      </div>
    </div>

    <!-- Completed task Modal -->
    <div class="modal fade" id="CompleteModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Mark as complete</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
              Yayy...We couldn't be more happier to see you complete your task?
          </div>

          <!-- Modal footer -->
          <div class="modal-footer" id="modalFooterCompleted">
          </div>
      </div>
    </div>
  </div>

  <!-- Delete task Modal -->
  <div class="modal fade" id="DeleteModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Task</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Are you want to delete the following task?
          <p id="printtaskid" class="text-gray-900 text-lg"></p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer" id="modalFooterDeleted">


        </div>
    </div>
  </div>
  </div>

      <!-- Bootstrap core JavaScript-->
      <script src="../vendor/jquery/jquery.min.js"></script>
      <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="../js/sb-admin-2.min.js"></script>

      <script>
      function getTaskId(a) {
        console.log(a);
        document.getElementById('modalFooterDeleted').innerHTML = '<a href="delete.php?id=' + a + '"><button type="submit" name="delete" class="btn btn-danger">Yes, Go ahead!</button>';
        document.getElementById('modalFooterCompleted').innerHTML = '<a href="complete.php?id=' + a + '"><button type="submit" name="complete" class="btn btn-success">Finally, I did it!</button>';
      }
      </script>

  </body>


</html>

<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BucketFUL | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>

    <?php

    include 'routes/dbcon.php';

    if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = " select * from registration where email = '$email' ";
    $query = mysqli_query($con, $email_search);

    $emailcount = mysqli_num_rows($query);

    if ($emailcount) {
      //if present then account exists
      $dbfetch = mysqli_fetch_assoc($query);

      $dbpass = $dbfetch['password'];

      $pass_decode = password_verify($password, $dbpass);

      $_SESSION['username'] = $dbfetch['username'];
      $_SESSION['id'] = $dbfetch['id'];

      if ($pass_decode) {
        ?>
        <div class="alert alert-success text-center" role="alert">
          Login successful!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <script>
          location.replace("home.php");
        </script>
        <?php
      }else{
        ?>
        <div class="alert alert-warning text-center" role="alert">
          Incorrect Password!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
      }

    }else{
      //account not exists
      ?>
      <div class="alert alert-warning text-center" role="alert">
        Email not registered!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
    }

    }
    ?>

    <!-- main html starts here -->
    <div class="card bg-light">
      <article class="card-body mx-auto" style="max-width: 400px;">
        <h4 class="card-title mt-3 text-center">Create Account</h4>
        <p class="text-center">Get started with your free account</p>
        <p>
          <a href="#" class="btn btn-block btn-google"> <i class="fa-brands fa-google"></i>Login via Gmail </a>
            <a href="#" class="btn btn-block btn-facebook"> <i class="fa-brands fa-facebook"></i>Login via Facebook </a>
        </p>

        <p class="divider-text">
          <span class="bg-light">OR</span>
        </p>

        <form action=" <?php echo htmlentities($_SERVER['PHP_SELF']); ?> " method="post">

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Log in</button>
          </div>

          <p class="text-center">Don't have an account? <a href="registration.php">Sign up here</a> </p>

        </form>

      </article>
    </div>
  </body>
</html>

<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BucketFUL | Registration</title>
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
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        //hashing Password
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

        //emailquery
        $emailquery = "select * from registration where email = '$email' ";
        $query = mysqli_query($con, $emailquery);

        $emailcount = mysqli_num_rows($query);

        if ($emailcount > 0) {
          // email already exists
          ?>
          <div class="alert alert-warning text-center" role="alert">
            Email already registered. Try registering with different email address!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
        }else{

          //check matching passwords
          if ($password === $cpassword) {
            //register new user
            $insertquery = " insert into registration(username, email, phone, password, cpassword) values('$username', '$email', '$phone', '$pass', '$cpass') ";
            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
              ?>
              <div class="alert alert-success text-center" role="alert">
                WooHoo...Account has been registered successfully. Now you can proceed to login!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php

              //go to home page

            }else{
              ?>
              <div class="alert alert-danger text-center" role="alert">
                  Insertion operation failed!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <?php
            }

          }else{
            ?>
            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
              Entered passwords don't match!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
        }

      }
    ?>

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
              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input type="text" name="username" class="form-control" placeholder="Full Name" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
          </div>

          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
          </div>

          <p class="text-center">Already have an account? <a href="login.php">Log in instead</a> </p>

        </form>

      </article>
    </div>
  </body>
</html>

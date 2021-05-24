<?php
require('include/header.php');
require('config/database.php');
?>
<?php
ob_start();
session_start();
?>
<title>Login Page</title>
<link rel="stylesheet" href="../public/css/style-login.css" />
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 vw-10 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">

          <!-- Images Div -->
          <div class="col-md-5" id="user-img">
            <img src="../public/assets/admin-login.jpg" class="login-card-img" alt="" id='admin-login-img' style='display:none;'>
            <img src="../public/assets/login-home.jpg" class="login-card-img" id='login-home-img' alt="">
            <img src="../public/assets/reviewer-login.png" class="login-card-img" id='reviewer-login-img' alt="" style='display:none;'>
            <img src="../public/assets/user-login.jpg" class="login-card-img" id='user-login-img' alt="" style='display:none;'>
          </div>

          <!-- Login-div -->

          <!-- Login Home -->
          <div class="col-md-7">
            <div class="card-body text-center" id='login-home-div' style="padding-top: 100px; padding-bottom:100px;">
              <img src="../public/assets/logo.jpg" width="120" height="120" style='margin:auto;'>

              <h3 style="font-family: 'Times New Roman', Times, serif;" class="pb-4">Conference Submission Portal</h3>
              <input type="button" class="btn btn-block btn-outline-primary" id='user-btn' value="User Login">
              <input type="button" id='reviewer-btn' class="btn btn-block btn-outline-dark" value="Reviewer Login">
              <input type="button" id='admin-btn' class="btn btn-block btn-outline-success" value="Admin Login">
            </div>

            <!-- Admin Login -->
            <div class="card-body text-center" id='admin-login-div' style='display:none;'>
              <h1 style="font-family: fantasy;">Admin Login</h1>
              <p class="login-card-description">Sign into your account</p>
              <div id="login">
                <div id="login-description" style="justify-content: center; margin:auto;"></div>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="form" style="margin: auto">
                  <div class="form-group text-left">
                    <label for="username" class="">Email</label>
                    <input type="username" name="email-admin" id="email-admin" class="form-control" placeholder="E-mail" />
                  </div>
                  <div class="form-group mb-2 text-left">
                    <label for="password" class="">Password</label>
                    <input type="password" name="password-admin" id="password-admin" class="form-control" style="margin-bottom:0px;" placeholder="***********" />
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                      Password and E-mail don't match
                    </div>
                  </div>
                  <div class="text-right mb-4">
                    <a href="index-forgot-password.php" target="_blank" class="mt-1 link-dark">Forgot Password</a>
                  </div>
                  <input name="admin-login" id="admin-login" class="btn btn-block login-btn mb-4" type="submit" value="Login" />
                </form>
              </div>
            </div>

            <!-- Reviewer Login -->

            <div class="card-body text-center" id='reviewer-login-div' style='display:none;'>
              <h1 style="font-family: fantasy;">Reviewer Login</h1>
              <p class="login-card-description">Sign into your account</p>
              <div id="login">
                <div id="login-description" style="justify-content: center; margin:auto;"></div>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="form" style="margin: auto">
                  <div class="form-group text-left">
                    <label for="username" class="">Email</label>
                    <input type="username" name="email-reviewer" id="email-reviewer" class="form-control" placeholder="E-mail" />
                  </div>
                  <div class="form-group mb-2 text-left">
                    <label for="password" class="">Password</label>
                    <input type="password" name="password-reviewer" id="password-reviewer" class="form-control" style="margin-bottom:0px;" placeholder="***********" />
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                      Password and E-mail don't match
                    </div>
                  </div>
                  <div class="text-right mb-4">
                    <a href="index-forgot-password.php" target="_blank" class="mt-1 link-dark">Forgot Password</a>
                  </div>
                  <input name="reviewer-login" id="reviewer-login" class="btn btn-block login-btn mb-4" type="submit" value="Login" />
                </form>
              </div>
            </div>


            <!-- User Login -->

            <div class="card-body text-center" id='user-login-div' style='display:none;'>
              <h1 style="font-family: fantasy;">User Login</h1>
              <p class="login-card-description">Sign into your account</p>
              <div id="login">
                <div id="login-description" style="justify-content: center; margin:auto;"></div>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="form" style="margin: auto">
                  <div class="form-group text-left">
                    <label for="username" class="">Email</label>
                    <input type="username" name="email-user" id="email-user" class="form-control" placeholder="E-mail" />
                  </div>
                  <div class="form-group mb-2 text-left">
                    <label for="password" class="">Password</label>
                    <input type="password" name="password-user" id="password-user" class="form-control" style="margin-bottom:0px;" placeholder="***********" />
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                      Password and E-mail don't match
                    </div>
                  </div>
                  <div class="mb-4">
                    <span class="pr-5 text-left">
                      <a href="index-forgot-password.php" target="_blank" class="mt-1 link-dark">Forgot Password</a>
                    </span>
                    <span class="pl-5 text-right">
                      <a href="index-forgot-password.php" class="mt-1 link-dark">Register Here</a>
                    </span>
                  </div>

                  <input name="user-login" id="user-login" class="btn btn-block login-btn mb-4" type="submit" value="Login" />
                </form>
              </div>
            </div>
            <div class="text-center" style="padding-bottom:50px;">
              <a href="" id='back-symbol' style='display:none;' class="text-center">Back to Login Home</a>
            </div>
          </div>

        </div>
      </div>
      <script src="../public/js/main-login.js"></script>
      <?php
      if (isset($_POST['admin-login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['email-admin']);
        $password = mysqli_real_escape_string($conn, $_POST['password-admin']);
        $sql = "SELECT * FROM admin WHERE email='$username' AND pass='$password';";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $count = mysqli_num_rows($query);
        if ($count == 1) {
          $_SESSION['logged_in'] = 'YES';
          $_SESSION['login_admin'] = $row['firstName'] . " " . $row['lastName'];
          //echo $_SESSION['logged_in'];
          echo "<script>perfect(); </script>";
          header('location: index-admin-home.php');
        } else {
          echo "<script> error('admin'); </script>";
        }
      }

      if (isset($_POST['reviewer-login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['email-reviewer']);
        $password = mysqli_real_escape_string($conn, $_POST['password-reviewer']);
        $sql = "SELECT * FROM reviewer WHERE email='$username' AND pass='$password';";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $count = mysqli_num_rows($query);
        if ($count == 1) {
          $_SESSION['logged_in'] = 'YES';
          $_SESSION['login_reviewer'] = $row['name'];
          $_SESSION['reviewer_id'] = $row['reviewer_id'];
          //echo $_SESSION['logged_in'];
          echo "<script>perfect(); </script>";
          header('location: index-reviewer-home.php');
        } else {
          echo "<script> error('reviewer'); </script>";
        }
      }

      if (isset($_POST['user-login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['email-user']);
        $password = mysqli_real_escape_string($conn, $_POST['password-user']);
        $sql = "SELECT * FROM user WHERE email='$username' AND pass='$password';";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $count = mysqli_num_rows($query);
        if ($count == 1) {
          $_SESSION['logged_in'] = 'YES';
          $_SESSION['login_user'] = $row['firstName'] . " " . $row['lastName'];
          $_SESSION['usn'] = $row['usn'];
          //echo $_SESSION['logged_in'];
          echo "<script>perfect(); </script>";
          header('location: index-home-user.php');
        } else {
          echo "<script> error('user'); </script>";
        }
      }
      ?>
    </div>
  </main>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
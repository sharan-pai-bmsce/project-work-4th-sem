<?php
require('include/header.php');
require('config/database.php');
?>
<script src="../public/js/main-login.js"></script>
<?php
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
          <div class="col-md-5" id="user-img">
            <img src="../public/assets/admin-login.jpg" class="login-card-img" alt="">
          </div>
          <div class="col-md-7">
            <div class="card-body text-center">
              <h1 style="font-family: fantasy;">Admin Login</h1>
              <div style="margin:auto;" id='message'></div>
              <p class="login-card-description">Sign into your account</p>
              <div id="login">
                <div id="login-description" style="justify-content: center; margin:auto;"></div>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="form" style="margin: auto">
                  <div class="form-group">
                    <label for="username" class="sr-only">Email</label>
                    <input type="username" name="email" id="email" class="form-control" placeholder="E-mail" />
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" />
                  </div>
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
  if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM admin WHERE email='$username' AND pass='$password';";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $count = mysqli_num_rows($query);
    if ($count == 1) {
      $_SESSION['logged_in'] = 'YES';
      $_SESSION['login_user'] = $row['firstName'] . " " . $row['lastName'];
      echo $_SESSION['logged_in'];
      echo "<script>perfect(); </script>";
      header('location: index-admin-home.php');
    } else {
      echo "<script> error(); </script>";
    }
  }
  ?>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
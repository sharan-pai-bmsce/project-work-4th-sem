<?php
session_start();
if($_SESSION['Hello']){
    unset($_SESSION['Hello']);
}else{
    header('location: ../views/index-login.php');
}

require('include/header.php');
require('config/database.php');
?>
<title>Password Reset</title>
<script src="../public/js/main-login.js"></script>
<link rel="stylesheet" href="../public/css/style-password.css">
</head>

<body style="background-color: #39b;">
    <div class="container pt-3" style="margin-bottom: 50px;">
        <h1 class="text-center display-3 pb-4" style="color: #eee;">Reset Password</h1>
        <div class="col-md-6 form" style="background-color: #fff;">
            <div class="input-grp">
            <form action='<?php $_SERVER['PHP_SELF'] ?>' method="POST">
                <div class="form-group">
                    <label for="email">Enter your email:</label>
                    <input type="text" name="email-for-change" id="email-for-change" placeholder="Enter email for verification" class="form-control">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        Please Enter a valid email.
                    </div>
                </div>
                <div class="form-group">
                    <label for="new-password">Enter the new Password:</label>
                    <input type="password" name="new-password" id="new-password" placeholder='Enter new password' class="form-control">
                </div>
                <div class="form-group">
                    <label for="new-password">Re-enter the new Password:</label>
                    <input type="password" name="reenter-new-password" id="reenter-new-password" placeholder='Re-enter new password' class="form-control">
                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                        Does not match with Password.
                    </div>
                </div>
                <div class="form-group">
                    <label for="unique-id">Enter unique verification id:</label>
                    <input type="password" name="unique-id" id="unique-id" placeholder='Enter unique id' class="form-control">
                    <div id="validationServerIdFeedback" class="invalid-feedback">
                        Please enter valid Id (Given while creating the account)
                    </div>
                </div>
                </div>
                <hr style="margin-top:0px;">
                <div class="col-md-12 text-center mb-3">
                    <input type="submit" class="btn col-md-6 btn-dark" value="Change Password" name='change-password'>
                </div>
        </div>
        </form>
    </div>
    </div>
    <?php 
        if (isset($_POST['change-password'])) {
            $username = mysqli_real_escape_string($conn, $_POST['email-for-change']);
            $password = mysqli_real_escape_string($conn, $_POST['new-password']);
            $reenter = mysqli_real_escape_string($conn, $_POST['reenter-new-password']);
            $id = mysqli_real_escape_string($conn, $_POST['unique-id']);
            if ($password!=''&&$username!=''&&$id!=''&&($password == $reenter)) {
              $sql = "UPDATE admin SET pass='$password' WHERE email='$username' AND verification='$id';";
              #echo "<h1>$sql</h1>";
              $query = mysqli_query($conn, $sql);
              #echo "<h1>$query</h1>";
              if ($query) {
                  header('location:index-login.php');
                  echo '<script>reload1();</script>';
              } else {
                echo "<script>errorEmailId();</script>";
              }
            }else{
                echo "<script>errorPassword();</script>";
            }
          }
    ?>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
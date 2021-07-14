<?php
require('include/header.php');
require('config/database.php');
?>
<title>Password Reset</title>
<link rel="stylesheet" href="../public/css/style-password.css">
</head>
<?php $stat = 0; ?>

<body style="background-color: #39b;">
    <div class="container pt-3" style="margin-bottom: 50px;">
        <h1 class="text-center display-3 pb-4" style="color: #eee;">Reset Password</h1>
        <div class="col-md-6 form" style="background-color: #fff;">
            <div class="input-grp">
                <form action='<?php $_SERVER['PHP_SELF'] ?>' method="POST">
                    <?php
                    if (isset($_POST['change-password'])) {
                        $username = mysqli_real_escape_string($conn, $_POST['email-for-change']);
                        $password = mysqli_real_escape_string($conn, $_POST['new-password']);
                        $reenter = mysqli_real_escape_string($conn, $_POST['reenter-new-password']);
                        $id = mysqli_real_escape_string($conn, $_POST['unique-id']);
                        $des = mysqli_real_escape_string($conn, $_POST['Designation']);
                        echo $id;
                        if ($password == $reenter) {
                            $stat = 1;
                            if ($des == 'reviewer') {
                                $sql = "SELECT * FROM reviewer WHERE email='$username' AND rid='$id';";
                                $query = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($query);
                                if ($count == 1)
                                    $sql = "UPDATE reviewer SET pass='$password' WHERE email='$username' AND rid='$id';";
                                else
                                    $stat = 2;
                            } else if ($des === 'users') {
                                $sql = "SELECT * FROM users WHERE email='$username' AND usn='$id';";
                                // echo $sql;
                                $query = mysqli_query($conn, $sql);
                                // echo " ".$query." ".mysqli_error($conn);
                                $count = mysqli_num_rows($query);
                                if ($count == 1)
                                    $sql = "UPDATE users SET pass='$password' WHERE email='$username' AND usn='$id';";
                                else
                                    $stat = 2;
                            } else {
                                $sql = "SELECT * FROM organizer WHERE email='$username' AND id='$id';";
                                $query = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($query);
                                if ($count == 1)
                                    $sql = "UPDATE organizer SET pass='$password' WHERE email='$username' AND id='$id';";
                                else
                                    $stat = 2;
                            }
                            if ($stat == 1) {
                                $query = mysqli_query($conn, $sql);
                                $check = mysqli_error($conn);
                                echo $check;
                                #echo "<h1>$query</h1>";
                                if ($query) {
                                    $stat = 1;
                                    // echo "<script>window.close();</script>";
                                    // header('index-fogot-password.php');
                                }
                            }
                        } else {
                            $stat = 4;
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label for="Designation">Enter your Designation:</label>
                        <select required name="Designation" id="designation" class="form-select">
                            <option value="">-- Select a designation --</option>
                            <option value="reviewer">Reviewer</option>
                            <option value="users">User</option>
                            <option value="organizer">Organizer</option>
                        </select>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            Please enter proper designation
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Enter your email:</label>
                        <input required type="text" name="email-for-change" id="email-for-change" placeholder="Enter email for verification" value="<?php if (isset($_POST['email-for-change']) && $stat != 1) {
                                                                                                                                                        echo $_POST['email-for-change'];
                                                                                                                                                    } ?>" class="form-control">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            Please Enter a valid email.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new-password">Enter the new Password:</label>
                        <input required type="password" name="new-password" id="new-password" placeholder='Enter new password' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new-password">Re-enter the new Password:</label>
                        <input required type="password" name="reenter-new-password" id="reenter-new-password" placeholder='Re-enter new password' class="form-control">
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            Does not match with Password.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unique-id">Enter unique verification id:</label>
                        <input required type="password" name="unique-id" id="unique-id" placeholder='Enter USN' value="<?php if (isset($_POST['unique-id']) && $stat != 1) {
                                                                                                                            echo $_POST['unique-id'];
                                                                                                                        } ?>" class="form-control">
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../public/js/main-forgot-password.js"></script>
    <?php
    if ($stat == 1) {
        echo "<script>
        swal({
              title: 'Password changed!',
              text: 'Your password has been changed!',
              icon: 'success',                          
            }).then(()=>{
                window.close();
            });
       
      </script>";
    } else if ($stat == 2) {
        echo "<script>errorEmailId();</script>";
    } else if ($stat == 4) {
        echo "<script>errorPassword();</script>";
    }
    echo $stat;
    ?>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
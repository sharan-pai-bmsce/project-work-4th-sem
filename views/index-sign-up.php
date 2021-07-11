<?php
require('include/header.php');
require('config/database.php');
?>

<?php
   session_start();
?>
    <title>Sign-up Page</title>
    <link rel="stylesheet" href="../public/css/style-sign-up.css" />
   
  </head>
  
  <body style="background-image:url('https://i.pinimg.com/originals/8a/6f/72/8a6f72839f6bdfa0de3a97afddcc9c0a.jpg');">
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
      <div class="container" style="width:60%; opacity:0.9;background-color:white;">
           <div class="row no-gutters">
               <div class="card-body text-center">
                <div class="" id="user-signin">
                  <p class="login-card-description">Sign up for an account</p>
                  <div id="msg"></div>
                  <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="text-left" style="margin: auto" id="user-form">
                    <div class="form-group">
                      <label for="USN" class="ml-2">USN<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="text"
                        name="USN"
                        id="USN"
                        class="form-control"
                        placeholder="Enter your USN"
                        required
                        minlength="10"
                        maxlength="10"
                      />
                    </div>
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="first-name" class="pl-2">First Name <span class="text-danger">*</span></label>
                        <input
                          type="text"
                          class="form-control"
                          id="first-name-input"
                          name="first_name"
                          placeholder="Enter your First Name"
                          required
                          maxlength="50"
                          pattern="[A-Za-z]{1,}"
                        />
                      </div>
                      <div class="col-md-6">
                        <label for="last-name" class="pl-2">Last Name <span class="text-danger">*</span></label>
                        <input
                          type="text"
                          class="form-control"
                          name="last_name"
                          id="last-name-input"
                          placeholder="Enter your Last Name"
                          required
                          pattern="[A-Za-z]{1,}"
                          maxlength="50"
                        />
                      </div>
                    </div>
                <div class="form-row">
                  <div class="col-md-6">
                        <label for="email" class="ml-2">E-mail<span style="color: red; margin-left: 1mm;">*</span></label>
                        <input
                          type="email"
                          name="email"
                          id="email"
                          class="form-control"
                          placeholder="E-mail"
                          required
                        />
                  </div>   
                 
                  <div class="col-md-6">
                        <label for="Mobile-no" class="pl-2">Mobile No. <span class="text-danger">*</span></label>
                        <input
                          type="text"
                          pattern="[0-9]{10,10}"
                          maxlength="10"
                          minlength="10"
                          name="Mobile"
                          id="mobile-input"
                          class="form-control"
                          placeholder="Enter the Mobile No."
                          required
                        />
                  </div>
                    
                </div>
             <div class="form-row">
                    <div class="col-md-6">
                   <label for="Institution" class="pl-2">Institution <span class="text-danger">*</span></label>
            <input
              type="text"
              name="Institution"
              id="institution-input"
              class="form-control"
              placeholder="Enter the institution"
              required
              pattern="[A-Z a-z]{3,}"
              maxlength="80"
            />
          </div>
           <div class="col-md-6">
            <label for="Nationality" class="pl-2">Nationality : <span class="text-danger">*</span></label>
            <input
              type="text"
              name="Nationality"
              id="Nationality-input"
              class="form-control"
              placeholder="Enter the Nationality (Country)"
              required
              pattern="[A-Z a-z]{4,}"
              maxlength="80"
            />
          </div>
          </div>
           <div class="form-group">
           <label for="Address" class="pl-2">Address <span class="text-danger">*</span></label>
             <textarea
              class="form-control"
              name="address"
              id="address-input"
              required="max length exeeded"
              placeholder="Address"
	             maxlength="100"
              height="50"
            ></textarea>
          </div>
          
                    <div class="form-row">
                    <div class="col-md-6">
                      <label for="password" class="ml-2">Password<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter the new password"
                        required
                        pattern=".{8,}" title="Must contain at least 8 or more characters"
                        maxlength="15"
                      />
                    </div>
                    <div class="col-md-6">
                      <label for="password" class="ml-2">Password Verification<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="password"
                        id="password_confirm"
                        name="password_confirm"
                        class="form-control"
                        placeholder="Re-enter the new password"
                        required
                        pattern=".{8,}" title="Must contain at least 8 or more characters"
                        maxlength="15"
                      />
                    </div>
                    </div>
                    <div class="text-center mt-3">
                    <input
                      name="Sign_up"
                      id="sign-up"
                      class="btn btn-dark mb-4"
                      type="submit"
                      value="Sign-up"
                      style="width:50%;"
                    />
                    </div>
                  </form>
                </div>
              </div>
            </div>
           <!-- <div class="col-md-6">
              <img src="list.png" style="
              border-radius: 0;
              position: absolute;
              width: 100%;
              height: 100%;
              object-fit: cover;">-->

            
            </div>
          </div>
        </div>
      </div>
    
    </main>
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
  <?php
  
    if(isset($_POST['Sign_up']))
    {
      $usn = mysqli_real_escape_string($conn, $_POST['USN']);
      $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
      $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $pass = mysqli_real_escape_string($conn,$_POST['password']);
      $nationality = mysqli_real_escape_string($conn,$_POST['Nationality']);
      $institution = mysqli_real_escape_string($conn,$_POST['Institution']);
      $mob_no = mysqli_real_escape_string($conn,$_POST['Mobile']);
      $address = mysqli_real_escape_string($conn,$_POST['address']);
      $pass_ver =mysqli_real_escape_string($conn,$_POST['password_confirm']);
      $query="INSERT INTO `users`(`usn`, `first_name`, `last_name`, `email`, `pass`, `nationality`, `institution`, `mob_no`, `address`) VALUES('$usn','$first_name','$last_name','$email','$pass','$nationality','$institution',$mob_no,'$address')";
    
      if($pass==$pass_ver)
      {
        if(mysqli_query($conn,$query))
        { 
          $_SESSION['logged_in'] = 'YES';
          $_SESSION['login_user'] = $first_name. " " . $last_name;
          $_SESSION['usn'] = $usn;
          //echo $_SESSION['logged_in'];
          //header('location: index-home-user.php');
          echo "<script>location.replace('index-home-user.php'); 
                </script>";
        }
        else
        { 
          $check=mysqli_error($conn);
          if(mysqli_error($conn)=="Duplicate entry '$usn' for key 'PRIMARY'")
            echo "<script>
                    swal({
                          title: 'Already Registered!',
                          text: 'Entered USN is already registered!',
                          icon: 'error',                          
                        });
                  </script>";
          else if(mysqli_error($conn)=="Duplicate entry '$mob_no' for key 'mob_no_uq'")
            echo "<script>
                    swal({
                          title: 'Already Registered!',
                          text: 'Entered Mobile Number is already registered!',
                          icon: 'error',                        
                        });
                  </script>";            
          else if(mysqli_error($conn)=="Duplicate entry '$email' for key 'email_uq'")
          echo "<script>
                    swal({
                          title: 'Already Registered!',
                          text: 'Entered Email-ID is already registered!',
                          icon: 'error',                        
                        });
                  </script>";            
          else
          echo "<script>
                  swal({
                        title: 'ERROR!',
                        text: 'An unexpected Error has ocurred, Sorry for the inconvenience!',
                        icon: 'error',                        
                      });
                </script>";            
        }
      }
      else
      {
        echo "<script>
                swal({
                      title: 'Password Mismatch!',
                      text: 'Please make sure your passwords match!',
                      icon: 'error',                        
                    });
              </script>"; 
      }
    
    }
    
    
  ?>
  </body>
</html>


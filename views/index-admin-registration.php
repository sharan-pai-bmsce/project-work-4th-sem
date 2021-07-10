<?php 
  require('include/header.php');
  
  require('config/database.php');
  $path = '/views/index-admin-registration.php';
  $title = 'REGISTRATION';
  if (isset($_POST['SUBMIT']))
  {
$RID=mysqli_real_escape_string($conn,$_POST['RID']);
$Name=mysqli_real_escape_string($conn,$_POST['Name']);
$registered_by=mysqli_real_escape_string($conn,$_POST['registered_by']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$publication_name=mysqli_real_escape_string($conn,$_POST['publication_name']);
$password=mysqli_real_escape_string($conn,$_POST['password']);

$query="INSERT INTO `reviewer`(`rid`,`name`,`email`,`pass`,`publication_name`,`registered_by`) Values('$RID','$Name','$email','$password','$publication_name','$registered_by')";
$stat=0;
if(mysqli_query($conn,$query))
{ $stat=1;
  
 
} else echo 'error'.mysqli_error($conn);
  }
?>
    <title>Registration</title>
    <link rel="stylesheet" href="../public/css/style-sub-admin.css">
  </head>
  <body style="background-color: #fff">
  <?php 
    require('include/navbar-admin.php');
  ?>
    <div class="container" id='registration-container' style="justify-content: center;background-color: #fff;">
    <body>
    
      <div class="container">
        
          <div class="row no-gutters">
           <div class="col-md-8">
            <div class="card-body text-center">
                <div class="" id="user-signin">
                  <p class="login-card-description"><h3>Register a Reviewer</h3></p>
                  <?php
               
                  if(isset($_POST['SUBMIT'])&&($stat==1))
                  echo "alert";
                    // inside "div ele"..... create a msg to pop up to show its registered
                  // else not registered
                  ?>
                  <form method ="POST" action="<?php $_SERVER['PHP_SELF'];?>" class="text-left" style="margin: auto" id="user-form">
                    <div class="form-group">
                      <label for="RID" class="ml-2">RID<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                       type="text"
                       name="RID"
                       id="RID"
                       class="form-control"
                       placeholder="Enter the reviwerer-id"
                       value=""
                       required
                       pattern="[a-z A-Z 0-9]{10}"
                       />
                      <label for="Name" class="ml-2">Name<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="text"
                        name="Name"
                        id="Name"
                        class="form-control"
                        placeholder=" Enter the Name"
                        value=""
                        required
                        pattern="[a-z A-Z]{2,}"
                      />
                    </div>
                    <label for="registered_by" class="ml-2">Registering Dept<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="text"
                        name="registered_by"
                        id="registered_by"
                        class="form-control"
                        placeholder="Enter the name of the registering person"
                        value=""
                        required
                        pattern="[a-z A-Z]{2,}"
                      />
                      <label for="publication_name name" class="ml-2">Publication name<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="text"
                        name="publication_name"
                        id="publication_name"
                        class="form-control"
                        placeholder="Enter the publication name"
                        value=""
                        required
                        pattern="[a-z A-Z]{2,}"
                      />
                    <div class="form-group">
                      <label for="email" class="ml-2">E-mail<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        placeholder="Enter the E-mail"
                        required
                      />
                    </div>
                    <div class="form-group mb-4">
                      <label for="password" class="ml-2">Password<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        placeholder="Enter the new password"
                        required
                        minlength="8"
                        maxlength="15"
                      />
                    </div>
                    <div class="form-group mb-4">
                      <label for="password" class="ml-2">Password Verification<span style="color: red; margin-left: 1mm;">*</span></label>
                      <input
                        type="password"
                        name='password'
                        id="password-confirm"
                        class="form-control"
                        placeholder="Re-enter the new password"
                        required
                        minlength="8"
                        maxlength="15"
                      />
                    </div>
                    <div class="text-center mt-3">
                      <input
                        name="SUBMIT"
                        id="SUBMIT"
                        class="btn btn-dark mb-4"
                        type="submit"
                        value="REGISTER NOW"
                        style="width:50%;"
                      />
                      </div>
                  </form>
                </div>
              </div>
            </div>
            
            </div>
          </div>
        </div>
        <?php //echo 'error'.mysqli_error($conn); ?>
    </main>
    
  </body>
  </div>
    <script src="main.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script>
      src =
        "https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js";
      integrity ="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx";
      crossorigin = "anonymous";
    </script>
  </body>
</html>

<?php
require('config/database.php');
require('include/header.php');
$path = '/views/index-submission.php';
$title = 'Submission Page';
$sql = "SELECT conferenceTitle,discussionTopic FROM announcements;";
$query = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_all($query, MYSQLI_ASSOC);
$sql = "SELECT name FROM countries";
$query = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_all($query, MYSQLI_ASSOC);
$sql = "SELECT name FROM state";
$query = mysqli_query($conn, $sql);
$row3 = mysqli_fetch_all($query, MYSQLI_ASSOC);
$sql = "SELECT name FROM college";
$query = mysqli_query($conn, $sql);
$row4 = mysqli_fetch_all($query, MYSQLI_ASSOC);
$stat=0;
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
var x = <?php echo(json_encode($row1)); ?>;
console.log(x);
</script>
<title>Submission Page</title>
<link rel="stylesheet" href="../public/css/style-submission.css" />
</head>
<body style="background-color: #ddd">
  <?php
  require('include/navbar-user.php');
  ?>
  <div class="container pl-3 pr-3 pt-2" style="background-color: #eee">
  <?php 
    // var_dump($row4);
  foreach ($row1 as $key => $value) {
      var_dump($value['conferenceTitle']);
  } ?>
    <div id="msg-div" class="mt-3">
      <div class="text-center alert-success pb-3" id='success' style='display:none;'>
        <h3 class="pb-2">Your conference paper has been submitted successfully.</h3> You may get a mail regarding it in 2-3 days. <h3 class="p-2">Thank You!!!</h3>
      </div>
    </div>
    <form id="submission-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
    <?php
    if (isset($_POST['submit'])) {
      foreach ($row1 as $key => $value) {
        if ($value['conferenceTitle'] == $_POST['conference-name'] && $value['discussionTopic'] == $_POST['topic-of-discussion']) {
          $stat = 1;
        }
      }
      // echo "$stat    ".$_POST['conference-name']."               ".$_POST['topic-of-discussion'] 
    }
    ?>
      <h3 class="text-center author" style="padding-top: 0px;">Author's Information</h3>
      <hr />
      <br />
      <div class="form-row align-items-center">
        <div class="col-md-2">
          <label for="prefix" class="pl-2">Prefix : <span class="text-danger">*</span></label>
          <select class="form-control" name="prefix" required id="prefix-input">
            <option value="Dr.">Dr.</option>
            <option value="Mr.">Mr.</option>
            <option value="Mrs.">Mrs.</option>
            <option value="Ms.">Ms.</option>
            <option value="Professor">Professor</option>
            <option value="Asst. Professor">Assistant Professor</option>
          </select>
        </div>
        <div class="col-md-5">
          <label for="first-name" class="pl-2">First Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name='first-name' id="first-name-input" value="<?php if(isset($_POST['first-name'])){if($stat==0)echo($_POST['first-name']);} ?>" placeholder="Enter your First Name" required maxlength="50" pattern="[A-Za-z]{1,}" />
        </div>
        <div class="col-md-5">
          <label for="last-name" class="pl-2">Last Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="last-name" id="last-name-input" value="<?php if(isset($_POST['last-name'])){if($stat==0)echo $_POST['last-name'];} ?>" placeholder="Enter your Last Name" required pattern="[A-Za-z]{1,}" maxlength="50" />
        </div>
      </div>
      <div class="alert-dark mt-3" id='conf-display' style='display:none;'>
        <?php
        echo "<h3 class='text-center'>Available Conferences</h3>";
        echo '<ol>';
        foreach ($row1 as $key => $value) {
          echo "<li class='p-2'><b>Conference Name: </b> " . $value['conferenceTitle'] . "<b class='pl-4'>Topic of Discussion:</b> " . $value['discussionTopic'] . "</li>";
        }
        echo '</ol>';
        ?>
      </div>
      <div class="form-row align-items-center pt-3">
        <div class="col-md-6">
          <label for="conference-name" class="pl-2">Conference Name <span class="text-danger">*</span></label>
          <!-- <input
            type="text"
            name="conference-name"
            id="conference-name-input"
            class="form-control"
            placeholder="Enter the Conference name"
            required
            pattern="[A-Z a-z]{4,}"
            maxlength="80"
          /> -->
          <select name="conference-name" required class="form-select" style='color:#6c757d;' id="conference-name-input">
            <?php
            echo "<option value=''>Select a Conference Name</option>";
            foreach ($row1 as $prop => $val) {
              echo("<option");
              if(isset($_POST['conference-name'])&&$_POST['conference-name']==$val['conferenceTitle']){
                if($stat==0)
                  echo " selected='true'";
              }
              echo  " value='$val[conferenceTitle]'> $val[conferenceTitle] </option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-6">
          <label for="topic-of-discussion" class="pl-2">Topic of Discussion <span class="text-danger">*</span></label>
          <select name="topic-of-discussion" required class="form-select" style='color:#6c757d;' id="discussion-input">
            <?php
            echo "<option value=''>Select a Discussion Topic</option>";
            foreach ($row1 as $prop => $val) {
              echo("<option");
              if(isset($_POST['topic-of-discussion'])&&$_POST['topic-of-discussion']==$val['discussionTopic']){
                if($stat==0)
                  echo " selected='true'";
              }
              echo  " value='$val[discussionTopic]'> $val[discussionTopic] </option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-12 pl-4 pt-2">
        <input type="checkbox" class="form-check-input" id="conference-show"><label for="conference-show">Information regarding on-going conference<span id='error-conf' style="display: none;color:red;">
            <--Entered discussion topic and conference name do not match with any on-going conferences.</span></label>
      </div>
      <div class="form-row align-items-center pt-1">
        <div class="col-md-4">
          <label for="Institution" class="pl-2">Institution <span class="text-danger">*</span></label>
          <input list="institution" name='institution' id="institution-input" value="<?php if(isset($_POST['institution'])){if($stat==0)echo $_POST['institution'];} ?>" class="form-control" placeholder="Enter the institution" required pattern="[A-Z a-z]{3,}" maxlength="80" >
          <datalist id="institution">
            <?php
              echo "<option value=''>Select a State</option>";
              foreach ($row4 as $prop => $val) {
                echo "<option value='$val[name]'> $val[name] </option>";
              }
            ?>
          </datalist>
          <!-- <input type="text" name="Institution" id="institution-input" class="form-control" placeholder="Enter the institution" required pattern="[A-Z a-z]{3,}" maxlength="80" /> -->
        </div>
        
        <div class="col-md-4">
          <label for="State" class="pl-2">State: </label>
          <select name="state" id="state-input" class="form-select" style='color:#6c757d;'>
            <?php
            echo "<option value=''>Select a State</option>";
            foreach ($row3 as $prop => $val) {
              echo("<option");
              if(isset($_POST['state'])&&$_POST['state']==$val['name']){
                if($stat==0)
                  echo " selected='true'";
              }
              echo  " value='$val[name]'> $val[name] </option>";
            }
            ?>
          </select>
        </div>
        
        <div class="col-md-4">
          <label for="Nationality" class="pl-2">Nationality : <span class="text-danger">*</span></label>
          <select name="nationality" id="Nationality-input" required class="form-select" style='color:#6c757d;'>
            <?php
            echo "<option value=''>Select a Country</option>";
            foreach ($row2 as $prop => $val) {
              echo("<option");
              if(isset($_POST['nationality'])&&$_POST['nationality']==$val['name']){
                if($stat==0)
                  echo " selected='true'";
              }
              echo  " value='$val[name]'> $val[name] </option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-row align-items-center pt-3">
        <div class="col-md-6">
          <label for="E-mail" class="pl-2">Author's Email Address <span class="text-danger">*</span></label>
          <input type="email" name="email" value="<?php if(isset($_POST['email'])){if($stat==0)echo $_POST['email'];} ?>" class="form-control" id="email-input" placeholder="Enter your email" required pattern="[a-z0-9.]+@[a-z0-9.-]+\.[a-z]{2,}" maxlength="80" />
        </div>
        <div class="col-md-6">
          <label for="Mobile-no" class="pl-2">Mobile No. <span class="text-danger">*</span></label>
          <input type="text" pattern="[0-9]{10}" value="<?php if(isset($_POST['mobile-no'])){if($stat==0)echo $_POST['mobile-no'];} ?>" maxlength="10" minlength="10" name="mobile-no" id="mobile-input" class="form-control" placeholder="Enter the Mobile No." />
        </div>
      </div>
      <div class="form-row align-items-center pt-3">
        <div class="col-md-6">
          <label for="Address" class="pl-2">Author's Address <span class="text-danger">*</span></label>
          <textarea class="form-control" name="address" value="<?php if(isset($_POST['address'])){if($stat==0)echo $_POST['address'];} ?>" id="address-input" required="max length exeeded" maxlength="100"><?php if(isset($_POST['address'])&&$stat==0){echo $_POST['address'];} ?></textarea>
        </div>
        <div class="col-md-6">
          <label for="Co-authors" class="pl-2">Co-Authors (if any)</label>
          <textarea class="form-control" name="Co-authors" value="<?php if(isset($_POST['Co-authors'])){if($stat==0)echo $_POST['Co-authors'];} ?>" id="co-authors-input" placeholder="Enter the Co-author's name"><?php if(isset($_POST['Co-authors'])&&$stat==0){echo $_POST['Co-authors'];} ?></textarea>
        </div>
      </div>
      <h3 class="text-center paper">Paper Information</h3>
      <hr />
      <br />
      <div class="form-row align-items-center">
        <label for="paper-title" class="pl-2">Paper Title <span class="text-danger">*</span></label>
        <input type="text" name="paper-title" value="<?php if(isset($_POST['paper-title'])&&$stat==0){echo $_POST['paper-title'];} ?>" id="paper-title-input" class="form-control" required pattern="[A-Z a-z]{4,}" maxlength="80" />
      </div>
      <div class="form-row align-items-center pt-3">
        <label for="paper-abstract" class="pl-2">Paper Abstract <span class="text-danger">*</span></label>
        <textarea name="paper-abstract" value="<?php if(isset($_POST['paper-abstract'])&&$stat==0){echo $_POST['paper-abstract'];} ?>" id="paper-abstract-input" class="form-control" style="min-height: 150px" required maxlength="100"><?php if(isset($_POST['paper-abstract'])&&$stat==0){echo $_POST['paper-abstract'];} ?></textarea>
      </div>
      <div class="form-group pt-3">
        <label for="file-upload">Paper Upload <span class="text-danger">*</span></label>
        <div class="custom-file">
          <input type="file" name="paper-upload" value="<?php if(isset($_POST['file-upload'])&&$stat==0){echo $_POST['file-upload'];} ?>" class="form-control-file" id="paper-upload-input" required accept=".pdf" />
        </div>
      </div>
      <div class="form-group pt-5">
        <h4 class="form-group">
          Terms and conditions <span class="text-danger">*</span>
        </h4>
        <div class="form-check">
          <input required type="checkbox" class="form-check-input mt-3" id="terms-condition" />
          <label for="terms-condition" class="pl-3 pr-3 form-check-label">
            I hereby agree with the <a href="#">terms and conditions</a>. I
            lay a copyright claim for the uploaded paper which will be
            presented in the conference. I pledge that this paper has been
            created by me and my team.
          </label>
        </div>
      </div>
      <div class="text-center col-md-12">
        <input name="submit" type="submit" value="Submit" id="submit-btn" class="btn submit-btn btn-outline-dark">
      </div>
    </form>
    <script src="../public/js/main-submission.js"></script>
    <?php 
      if(isset($_POST['submit'])){
        if ($stat == 1) {
          echo "<script> success(); </script>";
        }else{
            echo "<script>confError();</script>";
        }


      }

    ?>
    <div style="padding-bottom: 150px; margin-bottom: 50px;"></div>
  </div>
</body>

</html>
<?php
require('config/database.php');
require('include/header.php');
$path = '/views/index-submission.php';
$title = 'Submission Page';
session_start();
$sql = "SELECT DISTINCT conf_name FROM announcement;";
$query = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_all($query, MYSQLI_ASSOC);
$sql = "SELECT DISTINCT topic_of_discussion FROM announcement;";
$query = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_all($query, MYSQLI_ASSOC);
$sql = "SELECT conf_name,topic_of_discussion FROM announcement;";
$query = mysqli_query($conn, $sql);
$row3 = mysqli_fetch_all($query, MYSQLI_ASSOC);
$stat = 0;
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
  var x = <?php echo (json_encode($row1)); ?>;
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
    <div id="msg-div" class="mt-3 mb-3">
      <div class="text-center alert-success pb-3" id='success' style="display: none;" role='alert'>
      <button type='button' class="btn" id='close-btn' style="float: right;">
          <span aria-hidden='true'>×</span>
        </button>
        <h3 class="pb-2">Your conference paper has been submitted successfully.</h3> You may get a mail regarding it in 2-3 days. <h3 class="p-2">Thank You!!!</h3>
      </div>
    </div>

    <form id="submission-form" action="../views/index-submission.php" method="POST" enctype="multipart/form-data">
      <?php
      if (isset($_POST['submit'])) {
        $confName = test_input($_POST['conference-name']);
        $topic = test_input($_POST['topic-of-discussion']);
        foreach ($row3 as $key => $value) {
          if ($value['conf_name'] == $confName && $value['topic_of_discussion'] == $topic) {
            $stat = 1;
          }
        }
        $coAuthor = test_input($_POST['Co-authors']);
        $paperTitle = test_input($_POST['paper-title']);
        $paperAbstract = test_input($_POST['paper-abstract']);
        $usn = test_input($_SESSION['usn']);
        // File Upload code still incomplete but this part works.
        $filename = test_input($_FILES['upload']['name']);
        $temp1 = strtoupper($filename);
        $temp2 = strtoupper($_SESSION['usn'] . "_" . $_POST['topic-of-discussion'] . ".pdf");
        if ($temp1 !== $temp2) {
          $stat = 2;
        }
      }
      // echo "$stat    ".$_POST['conference-name']."               ".$_POST['topic-of-discussion'] 
      ?>
      <h3 class="text-center author" style="padding-top: 0px;">Author's Information</h3>
      <hr />
      <br />
      <div class="alert-dark mt-1" id='conf-display' style='display:none;'>
        <?php
        echo "<h3 class='text-center'>Available Conferences</h3>";
        echo '<ol>';
        foreach ($row3 as $key => $value) {
          echo "<li class='p-2'><b>Conference Name: </b> " . $value['conf_name'] . "<b class='pl-4'>Topic of Discussion:</b> " . $value['topic_of_discussion'] . "</li>";
        }
        echo '</ol>';
        ?>
      </div>
      <div class="form-row align-items-center">
        <div class="col-md-6">
          <label for="conference-name" class="pl-2">Conference Name <span class="text-danger">*</span></label>
          <select name="conference-name" required class="form-select" style='color:#6c757d;' id="conference-name-input">
            <?php
            echo "<option value=''>Select a Conference Name</option>";
            foreach ($row1 as $prop => $val) {
              echo ("<option");
              if (isset($_POST['conference-name']) && $_POST['conference-name'] == $val['conf_name']) {
                if ($stat == 0 || $stat == 2)
                  echo " selected='true'";
              }
              echo  " value='$val[conf_name]'> $val[conf_name] </option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-6">
          <label for="topic-of-discussion" class="pl-2">Topic of Discussion <span class="text-danger">*</span></label>
          <select name="topic-of-discussion" required class="form-select" style='color:#6c757d;' id="discussion-input">
            <?php
            echo "<option value=''>Select a Discussion Topic</option>";
            foreach ($row2 as $prop => $val) {
              echo ("<option");
              if (isset($_POST['topic-of-discussion']) && $_POST['topic-of-discussion'] == $val['topic_of_discussion']) {
                if ($stat == 0 || $stat == 2)
                  echo " selected='true'";
              }
              echo  " value='$val[topic_of_discussion]'> $val[topic_of_discussion] </option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-12 pl-4 pt-2">
        <input type="checkbox" class="form-check-input" id="conference-show"><label for="conference-show">Information regarding on-going conference<span id='error-conf' style="display: none;color:red;">
            <--Entered discussion topic and conference name do not match with any on-going conferences.</span></label>
      </div>
      <div class="">
        <label for="Co-authors" class="pl-2">Co-Authors (if any)</label>
        <textarea class="form-control" style="height:120px;" name="Co-authors" value="<?php if (isset($_POST['Co-authors'])) {
                                                                                        if ($stat == 0 || $stat == 2) echo $_POST['Co-authors'];
                                                                                      } ?>" id="co-authors-input" placeholder="Enter the Co-author's name"><?php if (isset($_POST['Co-authors']) && $stat == 0 || $stat == 2) {
                                                                                                                                                                echo $_POST['Co-authors'];
                                                                                                                                                              } ?></textarea>
      </div>
      <h3 class="text-center paper">Paper Information</h3>
      <hr />
      <br />
      <div class="form-row align-items-center">
        <label for="paper-title" class="pl-2">Paper Title <span class="text-danger">*</span></label>
        <input type="text" name="paper-title" value="<?php if (isset($_POST['paper-title']) && $stat == 0 || $stat == 2) {
                                                        echo $_POST['paper-title'];
                                                      } ?>" id="paper-title-input" class="form-control" required pattern="[A-Z a-z]{4,}" maxlength="80" />
      </div>
      <div class="form-row align-items-center pt-3">
        <label for="paper-abstract" class="pl-2">Paper Abstract <span class="text-danger">*</span></label>
        <textarea name="paper-abstract" value="<?php if (isset($_POST['paper-abstract']) && $stat == 0 || $stat == 2) {
                                                  echo $_POST['paper-abstract'];
                                                } ?>" id="paper-abstract-input" class="form-control" style="min-height: 150px" required maxlength="100"><?php if (isset($_POST['paper-abstract']) && ($stat == 0 || $stat == 2)) {
                                                                                                                                                            echo $_POST['paper-abstract'];
                                                                                                                                                          } ?></textarea>
      </div>
      <div class="form-group pt-3">
        <label for="file-upload">Paper Upload <span class="text-danger">*</span></label>
        <div class="custom-file">
          <p style='margin-bottom:5px;'>(Kindly make sure that the file name is in following format 'USN_topic-of-discussion')<span id="file-error" style='display:none;'>
              <-- You cannot submit if the filename is not in the format.</span>
          </p>
          <input type="file" name="upload" class="form-control-file" id="paper-upload-input" required accept=".pdf" />
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
    //var_dump($_SESSION);
    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    if (isset($_POST['submit'])) {
      if ($stat == 1) {
        $destination = 'Uploads/' . $filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['upload']['tmp_name'];
        $filesize = $_FILES['upload']['size'];
        $sql = "INSERT INTO submission(usn,conf_name,topic,co_authors,ptitle,abstract,file_name,file_size) VALUES ('$usn','$confName','$topic','$coAuthor','$paperTitle','$paperAbstract','$filename',$filesize);";
        if (move_uploaded_file($file, $destination)) {
          if (mysqli_query($conn, $sql))
            echo "<script> success(); </script>";
        }
      } else if ($stat == 2) {
        echo "<script>fileError();</script>";
      } else {
        echo "<script>confError();</script>";
      }
    }

    ?>
    <div style="padding-bottom: 150px; margin-bottom: 50px;"></div>
  </div>
</body>

</html>
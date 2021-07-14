<?php
// include("../views/vendor/autoload.php");
require('config/database.php');
require('include/header.php');
$path = '/views/index-submission.php';
$title = 'Submission Page';
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<title>Submission Page</title>
<link rel="stylesheet" href="../public/css/style-submission.css" />
</head>

<body>
  <?php
  require('include/navbar-user.php');
  $sql = "SELECT DISTINCT conf_name FROM announcement;";
  $query = mysqli_query($conn, $sql);
  $row1 = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $sql = "SELECT DISTINCT topic_of_discussion FROM announcement;";
  $query = mysqli_query($conn, $sql);
  $row2 = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $sql = "SELECT conf_name,topic_of_discussion FROM announcement;";
  $query = mysqli_query($conn, $sql);
  $row3 = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $sql = "Select ptitle from submission where usn='$_SESSION[usn]';";
  $query = mysqli_query($conn, $sql);
  $row4 = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $stat = 0;
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
        $confName = mysqli_real_escape_string($conn, $_POST['conference-name']);
        $topic = mysqli_real_escape_string($conn, $_POST['topic-of-discussion']);
        foreach ($row3 as $key => $value) {
          // echo "$value[conf_name], $value[topic_of_discussion]";
          // echo "$confName, $topic";
          if ($value['conf_name'] == $confName) {
            if ($value['topic_of_discussion'] == $topic) {
              // echo "world";
              $stat = 1;
            }
          }
        }
        if ($stat == 1) {
          $coAuthor = test_input(mysqli_real_escape_string($conn, $_POST['Co-authors']));
          $paperTitle = test_input(mysqli_real_escape_string($conn, $_POST['paper-title']));
          $paperAbstract = test_input(mysqli_real_escape_string($conn, $_POST['paper-abstract']));
          if ($row4 != null) {
            foreach ($row4 as $key => $value) {
              if ($value['ptitle'] === $paperTitle)
                $stat = 3;
            }
          }
          $usn = test_input(mysqli_real_escape_string($conn, $_SESSION['usn']));
          // File Upload code still incomplete but this part works.
          $filename = test_input(mysqli_real_escape_string($conn, $_FILES['upload']['name'][0]));
          $temp1 = strtoupper($filename);
          $temp2 = strtoupper($_SESSION['usn'] . "_" . $paperTitle . ".pdf");
          if ($temp1 !== $temp2) {
            $stat = 2;
          }
          $filename1 = test_input(mysqli_real_escape_string($conn, $_FILES['upload']['name'][1]));
          $temp1r = strtoupper($filename1);
          $temp2r = strtoupper($_SESSION['usn'] . "_" . $paperTitle . " plagiarism report.pdf");
          if ($temp1r !== $temp2r) {
            $stat = 4;
          }

          if ($stat === 1) {
            $destination = 'Uploads/' . $filename;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $file = $_FILES['upload']['tmp_name'][0];
            $filesize = $_FILES['upload']['size'][0];

            $destination1 = 'Uploads/' . $filename1;

            $extension = pathinfo($filename1, PATHINFO_EXTENSION);
            $file1 = $_FILES['upload']['tmp_name'][1];

            move_uploaded_file($file1, $destination1);
            include('vendor/autoload.php');
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($destination1);
            $text = $pdf->getText();
            // echo $text;
            if (strpos($text, "P la gia ris m")) {
              $x = substr($text, strpos($text, "P la gia ris m") - 7, 5);
            } else if (strpos($text, "R EP O RT")) {
              $x = substr($text, strpos($text, "R EP O RT") + 13, 7);
            } else {
              unlink($destination1);
              $stat = 5;
            }
          }
        }
        // echo $stat;
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
                if ($stat != 1)
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
                if ($stat != 1)
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
                                                                                        if ($stat != 1) echo $_POST['Co-authors'];
                                                                                      } ?>" id="co-authors-input" placeholder="Enter the Co-author's name"><?php if (isset($_POST['Co-authors']) && $stat != 1) {
                                                                                                                                                              echo $_POST['Co-authors'];
                                                                                                                                                            } ?></textarea>
      </div>
      <h3 class="text-center paper">Paper Information</h3>
      <hr />
      <br />
      <div class="form-row align-items-center">
        <label for="paper-title" class="pl-2">Paper Title <span class="text-danger">*</span></label>
        <input type="text" name="paper-title" value="<?php if (isset($_POST['paper-title']) && $stat != 1) {
                                                        echo $_POST['paper-title'];
                                                      } ?>" id="paper-title-input" class="form-control" required pattern="[A-Z a-z]{4,}" maxlength="80" />
        <span id='error-ptitle' style="display: none;color:red;">
          A conference paper of this title has already been submitted by you.</span>
      </div>
      <div class="form-row align-items-center pt-3">
        <label for="paper-abstract" class="pl-2">Paper Abstract <span class="text-danger">*</span></label>
        <textarea name="paper-abstract" value="<?php if (isset($_POST['paper-abstract']) && $stat != 1) {
                                                  echo $_POST['paper-abstract'];
                                                } ?>" id="paper-abstract-input" class="form-control" style="min-height: 150px" required maxlength="1000"><?php if (isset($_POST['paper-abstract']) && ($stat != 1)) {
                                                                                                                                                            echo $_POST['paper-abstract'];
                                                                                                                                                          } ?></textarea>
      </div>
      <div class="form-group pt-3">
        <label for="file-upload">Paper Upload <span class="text-danger">*</span></label>
        <div class="custom-file">
          <p style='margin-bottom:5px;'>(Kindly make sure that the file name is in following format 'USN_paper-title')<span id="file-error" style='display:none;'>
              <-- You cannot submit if the filename is not in the format.</span>
          </p>
          <input type="file" name="upload[]" class="form-control-file" id="paper-upload-input" multiple='multiple' required accept=".pdf" />
        </div>
      </div>
      <div class="form-group pt-3">

        <label for="file-upload">Plagiarism report upload <span class="text-danger">*</span></label>
        <div class="custom-file">
          <p style='margin-bottom:5px;'>(Kindly make sure that the file name is in following format 'USN_ptitle plagiarism report')<span id="report-error" style='display:none;'>
              <-- You cannot submit if the filename is not in the format.</span><span id='link-error' style='display:none;'> Kindly upload the report generated by anyone of the 2 above links for plagiarism check.</span>
          </p>
          <div class="pb-3">
            <b class="p-3 pl-1">Links you can use:</b>
            <a href="https://www.duplichecker.com/" class="link-dark pr-3" target="blank">1. Duplichecker</a>
            <a href="https://smallseotools.com/plagiarism-checker/" class="link-dark pl-3" target="blank">2. Small SE Tools</a>
          </div>
          <input type="file" name="upload[]" class="form-control-file" id="report-input" multiple='multiple' required accept=".pdf" />
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        $x = str_replace(" ", "", $x);
        $x = str_replace("\t", "", $x);
        $x = str_replace("\n", "", $x);

        $sql = "INSERT INTO submission(usn,conf_name,topic,co_authors,ptitle,abstract,file_name,file_size,plag_percent,plag_file) VALUES ('$usn','$confName','$topic','$coAuthor','$paperTitle','$paperAbstract','$filename',$filesize,'$x','$filename1');";
        if (move_uploaded_file($file, $destination)) {
          // echo $sql;
          if (mysqli_query($conn, $sql)) {
            // // the message
            // $msg = "First line of text\nSecond line of text";

            // // use wordwrap() if lines are longer than 70 characters
            // $msg = wordwrap($msg, 70);

            // // send email
            // mail("shashanksharma.cs19@bmsce.ac.in", "My subject", $msg);
            echo "<script>
            swal({
              title: 'Paper has been submitted!',
              text: 'You will get an update about your submission in 2-3 days on the feedback page!',
              icon: 'success',                          
            });
            </script>";
          } else {
            $error = mysqli_error($conn);
            echo $error;
          }
        }
        // } else {
        // }
      } else if ($stat == 2) {
        echo "<script>fileError();</script>";
      } else if ($stat == 3) {
        echo "<script>ptitleError();</script>";
      } else if ($stat == 4) {
        echo "<script>reportError();</script>";
      } else if ($stat == 5) {
        echo "<script>linkError();</script>";
      } else {

        echo "<script>confError();</script>";
      }
    }

    ?>
    <div style="padding-bottom: 150px; margin-bottom: 50px;"></div>
  </div>
</body>

</html>
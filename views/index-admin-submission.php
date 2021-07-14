<?php
require('include/header.php');
require('config/database.php');
$path = '/views/index-admin-submission.php';
$title = 'Submissions Page';
?>

<link rel="stylesheet" href="../public/css/style-admin-submission.css">
<title>Feedback Page</title>
</head>

<body style="background-color: white">
  <?php
  require('include/navbar-admin.php');
  ?>
  <div class="container" style='margin-top:190px;'>
    <?php
    $sql = "SELECT conf_name,topic_of_discussion FROM announcement WHERE dept='$_SESSION[admin_dept]';";
    $result = mysqli_query($conn, $sql);
    if($result){
      $row1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
      $error=mysqli_error($conn);
      echo $error." Hello";
    }
    $sql = "SELECT conf_name,topic,pid,ptitle,abstract,status FROM submission where (conf_name,topic) IN (SELECT conf_name,topic_of_discussion FROM announcement WHERE dept='$_SESSION[admin_dept]');";
    $result = mysqli_query($conn, $sql);
    if($result)
      $row2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    else{
      $error=mysqli_error($conn);
      echo $error." Hello";
    }
    //print_r($row2);
    // $x = json_encode($row2);
    ?>
    
    <?php
    foreach ($row1 as $key1 => $value1) {
      echo "<h2 class='text-center pt-3 pb-3'>$value1[conf_name] --  $value1[topic_of_discussion]</h2>";
      $count = 0;
      foreach ($row2 as $key => $value) {
        if ($value['conf_name'] == $value1['conf_name'] && $value1['topic_of_discussion'] == $value['topic']&&$value['status']==1) {
          $count++;
          echo "<div class='border border-dark p-3 rounded mb-2'>
                <h5><b>Paper Id: </b>$value[pid]</h5>
                <h5><b>Paper Title: </b>$value[ptitle]</h5>
                <h5><b>Paper Abstract: </b>$value[abstract]</h5>
                ";
          if ($value['status'] == 1) {
            echo "<h5><b>Status: </b>Approved</h5>";
            echo "<div class='text-center'><a target='_blank' href='./index-user.php?pid=$value[pid]' class='btn btn-primary m-2 col-md-6' style='padding-left:12%;padding-right:12%;' >Expand</a>";
            echo "</div>
        </div>";
          } else {
            echo "<div class='text-center'>
                <button id='expand-btn' class='btn btn-primary m-2' style='padding-left:12%;padding-right:12%;'>Expand</button>              
                </div>            
              </div>";
          }
        }
      }
      if ($count == 0) {
        echo "<h3 class='text-center pt-3 pb-3'>No Submissions yet!!!</h3>";
        echo "<img style='margin-left:42.5%;' class='mb-3' src='../public/assets/empty-notification.jpeg'>";
      }
    }

    ?>
    <div style='padding-bottom:100px;'></div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
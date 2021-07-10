<?php
require('config/database.php');
require('include/header.php');
$path = '/views/index-reviewer-home.php';
$title = 'Reviewer Home';
//$dom=new DOMDocument();
//$dom->loadHTML('../views/index-reviewer-home.php');
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../public/css/style-home-reviewer.css">
<title>Reviewer Home</title>
</head>

<body style="background-color: white">
  <?php
  require('include/navbar-reviewer.php');
  ?>
  <div class="container">
    <?php
    $sql = "SELECT conf_name,topic_of_discussion FROM announcement WHERE rid='$_SESSION[reviewer_id]';";
    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $sql = "SELECT conf_name,topic,pid,ptitle,abstract,status FROM submission where (conf_name,topic) IN (SELECT conf_name,topic_of_discussion FROM announcement WHERE rid='$_SESSION[reviewer_id]');";
    $result = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print_r($row2);
    $x = json_encode($row2);
    ?>
    <?php
    foreach ($row1 as $key1 => $value1) {
      echo "<h2 class='text-center pt-3 pb-3'>$value1[conf_name] --  $value1[topic_of_discussion]</h2>";
      foreach ($row2 as $key => $value) {
        if ($value['conf_name'] == $value1['conf_name'] && $value1['topic_of_discussion'] == $value['topic']) {
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
    }

    ?>
    <!-- <a target='_blank' href='./index-user.php?pid=$value[pid]' class='btn btn-primary m-2' style='padding-left:12%;padding-right:12%;' >Expand</a> -->
  </div>
  <?php
  echo "<script>
    let expand = document.querySelectorAll('#expand-btn');
    expand.forEach((ex)=>{ex.addEventListener('click',(e)=>{
      e.preventDefault();
      let pid=ex.parentElement.parentElement.children[0].innerText;
      console.log(pid);
      pid=pid.slice(9);
      pid=parseInt(pid);
      console.log(pid);
      
      window.open('./index-user.php?pid='+pid);
    })});
  </script>";


  ?>
</body>

</html>
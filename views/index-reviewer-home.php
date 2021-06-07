<?php
require('config/database.php');
require('include/header.php');
$path = '/views/index-reviewer-home.php';
$title = 'Reviewer Home';
?>

<link rel="stylesheet" href="../public/css/style-home-reviewer.css">
<title>Reviewer Home</title>
</head>

<body style="background-color: white">
  <?php
  require('include/navbar-reviewer.php');
  ?>
  <div class="container">
      <?php
        var_dump($_SESSION);
        $sql = "SELECT conf_name,topic_of_discussion FROM announcement WHERE rid='$_SESSION[reviewer_id]';";
        echo $sql;
        $result = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $sql = "SELECT * FROM submission where conf_name='$row1[conf_name]' AND topic='$row1[topic_of_discussion]';";
        echo $sql;
        $result = mysqli_query($conn,$sql);
        $row2 = mysqli_fetch_array($result,MYSQLI_ASSOC);
        var_dump($row2);
      ?>
      
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
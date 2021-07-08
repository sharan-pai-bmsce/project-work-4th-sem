<?php
require('include/header.php');
require('config/database.php');
session_start();
$path = '/views/index-contact.php';
$title = 'Inbox';
$sql = "SELECT email FROM users where usn='$_SESSION[usn]';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$sql = "SELECT * FROM feedback WHERE to_email='$row[email]'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<title>Contact-Us Page</title>
<link rel="stylesheet" href="../public/css/style-contact.css">
</head>

<body style="background-color: #ddd">
  <?php
  require('include/navbar-user.php');
  ?>
  <div class="container pl-3 pr-3 pt-2" style="margin-top: 200px;background-color: #eee">
    <?php 
    foreach ($row as $key => $value) {
      echo "<div class='border border-dark p-3 rounded mb-2'>
      <h5><b>From: </b>$value[from_email]</h5>
      <h5><b>Subject: </b>$value[subject]</h5>
      <h5><b>Paper Title: </b>$value[ptitle]</h5>
      <h5><b>Conference: </b>$value[conference]</h5>
      <h5><b>Topic: </b>$value[topic]</h5>
      <h5>$value[reco]</h5>
      </div>
      ";
    }
      
    ?>
  </div>
  <div style="margin-bottom: 50px;"></div>
  <script src="main.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
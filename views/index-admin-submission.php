<?php 
  require('include/header.php');
  $path = '/views/index-admin-submission.php';
  $title = 'Submission Table';
?>
    <title>Submissions</title>
    <link rel="stylesheet" href="../public/css/style-sub-admin.css">
  </head>
  <body style="background-color: #fff">
  <?php 
    require('include/navbar-admin.php');
  ?>
    <div class="container" id='submission-container' style="justify-content: center;background-color: #fff;">
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
      integrity =
        "sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx";
      crossorigin = "anonymous";
    </script>
  </body>
</html>

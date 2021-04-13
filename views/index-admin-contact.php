<?php 
  require("include/header.php");
  $path = '/views/index-admin-contact.php';
  $title = 'Contact Table';
  ?>
    <title>Contact-Us Responses</title>
    <link rel="stylesheet" href="../public/css/style-contact-admin.css">
  </head>

  <body style="background-color: white"> 
      <?php require('include/navbar-admin.php') ?>
      <div class="tablem container">
        <div id="msg-div"></div>
        <table id="Contact-Us Responses" style= "font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" class="table">
            <thead class="text-center">
              <td><h5>Sl. No.</h5></td>
                <td><h5>Name</h5></td>
                <td><h5>Email</h5></td>
                <td><h5>Subject</h5></td>
                <td><h5>Message</h5></td>
                <td><h5>Cancel</h5></td>
            </thead>
          
          <tbody class="text-center" style="font-size: large;" id="Contact-Us-response">
             
            </tbody>
        </table>
    </div>
    
    <div style="margin-bottom:400px;"></div>
    <script src="main.js"></script>
      <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
      ></script>
      <!-- <script src="main-form.js"></script> -->
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>

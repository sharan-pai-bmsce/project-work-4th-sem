<?php
  require('include/header.php');
  $path = '/views/index-contact.php';
  $title = 'Contact Us page';
?>
    <title>Contact-Us Page</title>
    <link rel="stylesheet" href="../public/css/style-contact.css">
  </head>
  <body style="background-color: #ddd">
  <?php 
    require('include/navbar-user.php');
  ?>    
    <div class="wrap">
    <div class="floatleft"><h2 style="color:grey";>Contact Us:</h2>
       <pre>If you have any question or need any 
assistance regarding the conference,
paper submission and/or general request
please feel free to contact us.
		
Email Address: <a href="mailto:cs.office@bmsce.ac.in">cs.office@bmsce.ac.in</a>
	
Phone: 080 12345678 
</pre>     	  
    </div>
    
    <div class="floatleft2">
      <div id="msg-div"></div>
    <form id="contact-form" action="">
  
  <pre style="font-size:130%"><input type="text" id="name" name="name" size="25" required> <label for="name">  Your Name*</label><br><br></pre>
                                                                     
  <pre style="font-size:130%"><label for="email">Your Email*</label>   <input type="email" id="email" name="email" size="44" required><br><br></pre>
  
  <pre style="font-size:120%"><label for="subject">Subject*</label><br><input type="text" id="subject" name="subject" size="59" required><br></pre>
  
  <p style="font-size:135%">Message*</p>
  <textarea name="message" id="message" rows="4" cols="92">
</textarea>
<p>*Required<p>
 
  <div style="text-align: center;"><br><input type="submit" value="Submit"></div>
</form> 
</div>
    
    <div class="floatleft3">
	<a href='https://www.facebook.com/'><img src="../public/assets/fb-contact.png" style="width:45px;height:45px;"></a>
	<br><br><br><br>
	<a href='https://twitter.com/?lang=en'><img src="../public/assets/twitter-contact.jpg" style="width:45px;height:45px;"></a>
	</div>
    	
    <div style="clear: both;"></div>
</div>
     <div style="margin-bottom: 50px;"></div> 
     <script src="main.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
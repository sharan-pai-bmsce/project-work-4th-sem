<?php 
  require('config/database.php');
  require('include/header.php');
  $path = '/views/index-home-user.php';
  $title = 'Conference Home';
?>
    <title>2020 Conference</title>
    <link rel="stylesheet" href="../public/css/style-home-user.css">
  </head>
  <body>
  <?php 
    require('include/navbar-user.php');
  ?>
        <section id="home">
      <h1 class="h-primary">2020 ACADEMIC CONFERENCE</h1>
      <h1>The Challenge Of Change</h1>
    </section>
    <div class="container">
    <section id="mission-container">
      <h1 class="h-primary center">Our Mission</h1>
      <div id="mission">
        <div class="box">
          <img
            src="https://www.seekpng.com/png/detail/29-295350_pencil-sketch-logos-clip-art-transparent-download-logo.png"
            alt=""
          />
          <h2 class="h-secondary center">Providing Oppertunities</h2>
          <p class="center">
            Conference paper can be effective way to try out new ideas,introduce
            your to the colleagues and hone your research questions. Presenting
            at a conference is a great way to get valuable feedback from a
            community of scholars and for increasing you prefessional stature in
            your field. So get ready to widen your horizen!
          </p>
        </div>
        <div class="box">
          <img
            src="https://forum.teachingbooks.net/wp-content/uploads/2020/01/tb_bookonly_logo_square_600px-e1578263807999.jpg"
            alt=""
          />
          <h2 class="h-secondary center">Academic Growth</h2>
          <p class="center">
            There are many benefits associated with presenting your work at a
            conference. For example, students who have presented at conferences
            have reported they learn a great deal from others’ research, make
            valuable contacts through networking, find the experience helpful in
            preparing them for graduate school and appreciate the opportunity to
            improve their presentation skills and showcase their project to
            others
          </p>
        </div>
        <div class="box">
          <img
            src="https://www.pngitem.com/pimgs/m/409-4092162_free-handshake-logo-png-transparent-shaking-hands-png.png"
            alt=""
          />
          <h2 class="h-secondary center">Networking</h2>
          <p class="center">
            Conferences can give you a wonderful opportunity to meet and
            interact with fellow researchers, attendees and experts from the
            same or similar areas across the world. When you connect with
            scientists and academics, you can share views, create new
            relationships, learn new things and enhance your existing knowledge.
            It also seeds the link for scientific cooperation by meeting
            researchers from various countries. These connections can help you
            with your work to progress your research.
          </p>
        </div>
      </div>
    </section>
  </div>
  <section id="update-section" class="container">
    <h1 class="h-primary center">Updates</h1>
    <div id="update">
      <div style="margin-bottom: 50px;"></div>
      <div class="announce-display row" id="announce-display" style='display:none;'>
          <div id="img-area" class="col-md-5" style="padding-left:0px;"></div>
          <div id="announce-area" class="announce-area col-md-7 p-2"></div>
      </div>
      <div class="clearfix mt-3">
          <button class="btn btn-danger float-right" id="close-btn">Close</button>
      </div>
      <div id="announce-container" class="text-center mt-3 form-row"></div>
      <div style="margin-bottom: 200px;"></div>
    </div>
  </section>
  
  <?php 
    $date = date('Y-m-d');
    $sql = "SELECT file_name,plag_file from submission WHERE (conf_name,topic) in (SELECT conf_name,topic_of_discussion FROM announcement where date_of_conf<'$date');";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach ($row as $key => $value) {
      echo "Deleted $value[file_name]";
      unlink('Uploads/'.$value['file_name']);
      unlink('Uploads/'.$value['plag_file']);
      echo "Deleted $value[plag_file]";
    }
    $sql = "DELETE from announcement where date_of_conf<'$date'";
    $result = mysqli_query($conn,$sql);
    $sql = "SELECT a.conf_name,a.topic_of_discussion,a.summary,a.date_of_conf,a.last_date_sub,a.image_url,a.dept,r.name,r.publication_name FROM announcement a,reviewer r where a.rid=r.rid;";
    $result = mysqli_query($conn,$sql);
    $row1 = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $json_announcements = json_encode($row1);
  ?>
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
    <script>
      let announcement = <?php echo "$json_announcements"; ?>
    </script>
    <script src="../public/js/main-user-home.js"></script>
  </body>
</html>

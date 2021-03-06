<?php
require('include/header.php');
$path = '/views/index-admin-home.php';
$title = 'Admin Home';
// session_start();
?>
<?php
// require('database.php');
require('config/database.php')
?>

<link rel="stylesheet" href="../public/css/style-home-admin.css">
<title>2020 ACADEMIC CONFERENCE</title>
</head>

<body style="background-color: white">
  <?php
  require('include/navbar-admin.php');
  $sql = "SELECT rid,name,email,registering_dept FROM reviewer WHERE registering_dept='$_SESSION[admin_dept]' AND rid NOT IN (SELECT rid FROM announcement GROUP BY rid HAVING count(*)>=2);";
  $result = mysqli_query($conn, $sql);
  $row12 = mysqli_fetch_all($result, MYSQLI_ASSOC);
  ?>
  <section class="background firstSection">
    <div class="box-main">
      <div class="firstHalf">
        <p class="text-big">2020 ACADEMIC CONFERENCE</p>
        <p class="text-small" style="text-align: justify">
          An efficient platform to share your ideas and widen your horizen.
          This is your step towards the future!
        </p>
      </div>
    </div>
  </section>
  <div class="container-1">
    <section class="section">
      <div class="paras">
        <p class="sectionTag text-big">Spark New Ideas</p>
        <p class="sectionSubTag text-small" style="text-align: justify">
          Conferences are a great way for employees to be inspired by fresh
          ideas, to start rethinking the status quo, and to hopefully leave
          ready to tackle business challenges in creative and innovative ways.
          Conferences also allow individuals to share their progress, hurdles
          they’ve come across, and techniques devised for solving them. After
          hearing from leading experts and visionaries on how they found
          success, attendees are inspired and encouraged to think outside the
          box, which leads to successful outcomes for the organization.
        </p>
      </div>
      <div class="thumbnail">
        <img src="https://source.unsplash.com/900x900/?coding,apple" alt="laptop image" class="imgFluid" />
      </div>
    </section>

    <section class="section section-left" id="about">
      <div class="paras">
        <p class="sectionTag text-big">Learning</p>
        <p class="sectionSubTag text-small" style="text-align: justify">
          Another advantage of conferences is that they provide a blended
          learning environment with multiple opportunities for individuals to
          learn and engage in a wide array of formats. Conferences typically
          provide special guest speakers, breakout sessions, one-on-one
          engagements, group outings, and events for social interaction. The
          learning facet of a conference can expose attendees to new ways of
          operating and can help them discover ways to be even more
          productive. Whichever way an individual learns best, there are
          multiple ways to learn something new and impactful.
        </p>
      </div>
      <div class="thumbnail">
        <img src="https://source.unsplash.com/900x900/?coding,apple,html" alt="laptop image" class="imgFluid" />
      </div>
    </section>
    <section class="section" id="services">
      <div class="paras">
        <p class="sectionTag text-big">Let's Grow Together</p>
        <p class="sectionSubTag text-small" style="text-align: justify">
          The role of a conference is to gather like-minded individuals from
          across the country or across the globe, to learn, discuss thoughts,
          network, share ideas, create new ideas, and to ignite motivation.
          The benefits of attending a conference are different for everyone.
        </p>
      </div>
      <div class="thumbnail">
        <img src="https://source.unsplash.com/900x900/?javascript,apple" alt="laptop image" class="imgFluid" />
      </div>
    </section>
    <section class="container" id="news">

      <!-- <div id="msg-div"></div> -->
      <?php
      $insert = false;
      $update = false;
      $delete = false;
      if (isset($_GET['conf'])) {
        $conf_name = urldecode($_GET['conf']);
        $topic_of_discussion = urldecode($_GET['topic']);
        $delete = true;
        $sql = "SELECT email,file_name,plag_file from users u,submission s WHERE u.usn=s.usn AND conf_name='$conf_name' AND topic='$topic_of_discussion';";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        var_dump($row);
        foreach ($row as $key => $value) {
          echo "Deleted $value[file_name]";
          unlink('Uploads/' . $value['file_name']);
          unlink('Uploads/' . $value['plag_file']);
          echo "Deleted $value[plag_file]";
          $msg="$conf_name has been canceled due to some unfortunate reasons. Sorry that your conference paper couldn't be presented. But we suggest you keep looking into the news and announcements for future conferences.\nThank you.\nYours Sincerely\n$_SESSION[login_admin]\n$_SESSION[admin_dept]";
          $msg=wordwrap($msg,100);
          mail($value['email'],"Cancelation of $conf_name-$topic_of_discussion",$msg);
        }
        $sql = "DELETE FROM `announcement` WHERE `conf_name` = '$conf_name' and `topic_of_discussion`='$topic_of_discussion'";
        $result = mysqli_query($conn, $sql);
        //header('location:index-admin-home.php');
        echo "<script>
  location.replace('index-admin-home.php')
  </script>";
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['conf_nameEdit'])) {
          // Update the record
          $conf_name = mysqli_real_escape_string($conn, $_POST["conf_nameEdit"]);
          $topic_of_discussion = mysqli_real_escape_string($conn, $_POST["topic_of_discussionEdit"]);
          $last_date_sub = mysqli_real_escape_string($conn, $_POST["last_date_subEdit"]);
          $date_of_conf = mysqli_real_escape_string($conn, $_POST["date_of_confEdit"]);
          $summary = mysqli_real_escape_string($conn, $_POST["summaryEdit"]);
          $image_url = mysqli_real_escape_string($conn, $_POST["image_urlEdit"]);
          $rid = mysqli_real_escape_string($conn, $_POST["ridEdit"]);
          $dept = mysqli_real_escape_string($conn, $_POST["deptEdit"]);
          //var_dump($_POST);

          // Sql query to be executed
          $sql = "UPDATE `announcement` SET `summary` = '$summary' , `date_of_conf` = '$date_of_conf' , `last_date_sub` = '$last_date_sub' , `image_url` = '$image_url' , `dept` = '$dept' ,  `rid` = '$rid' WHERE `announcement`.`conf_name` = '$conf_name' and `announcement`.`topic_of_discussion` = '$topic_of_discussion'";
          $result = mysqli_query($conn, $sql);
          //echo $sql;
          if ($result) {
            $update = true;
          }
        } else {
          $conf_name = mysqli_real_escape_string($conn, $_POST["conf_name"]);
          $topic_of_discussion = mysqli_real_escape_string($conn, $_POST["topic_of_discussion"]);
          $last_date_sub = mysqli_real_escape_string($conn, $_POST["last_date_sub"]);
          $date_of_conf = mysqli_real_escape_string($conn, $_POST["date_of_conf"]);
          $summary = mysqli_real_escape_string($conn, $_POST["summary"]);
          $image_url = mysqli_real_escape_string($conn, $_POST["image_url"]);
          $rid = mysqli_real_escape_string($conn, $_POST["rid"]);
          $dept = mysqli_real_escape_string($conn, $_POST["dept"]);
          $last = strtotime($last_date_sub);
          $conf = strtotime($date_of_conf);
          $stat=0;
          foreach ($row12 as $key => $value) {
            if($value['rid']==$rid){
              $stat=1;
            }
          }
          
          if ($conf > $last&&$stat==1) {
            $sql = "INSERT INTO `announcement` (`conf_name`, `topic_of_discussion` , `summary`, `date_of_conf`, `last_date_sub`, `image_url`, `rid`, `dept`) VALUES ('$conf_name', '$topic_of_discussion' ,'$summary', '$date_of_conf', '$last_date_sub', '$image_url', '$rid', '$dept')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
              $insert = true;
            }else{
              $error = mysqli_error($conn);
              echo $error;
            }
          }else{
            $insert = false;
          }
        }
      }
      ?>
      <div class="news">
        <h1 class="text-center">News And Announcement</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if ($insert) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your record has been inserted successfully
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
      </button>
    </div>";
          }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error!</strong> You might have made some error in reviewer id or the dates.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
      </button>
    </div>";
          }
          echo "<script>window.scrollBy(0,1500);</script>";
        }
        ?>

        <?php
        if ($update) {
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your record has been updated successfully
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
      </button>
    </div>";
        }
        ?>

        <form action="/project-work-2/views/index-admin-home.php" class="pb-5" method="POST" id="form">
          <div class="form-group">
            <label for="heading" class="pl-1">
              <h5>Title:</h5>
            </label>
            <input type="text" class="form-control" name="conf_name" id="conf_name" value="<?php if(isset($_POST['conf_name'])&&!$insert) echo $_POST['conf_name']; ?>"/>
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1">
              <h5>Topic Of Discussion:</h5>
            </label>
            <input type="text" class="form-control" name="topic_of_discussion" id="topic_of_discussion" value="<?php if(isset($_POST['topic_of_discussion'])&&!$insert) echo $_POST['topic_of_discussion']; ?>"/>
          </div>
          <div class="alert-dark mt-1" id='conf-display' style="display: none;">
            <?php
            echo "<h3 class='text-center'>Available Reviewer Details</h3>";
            echo '<ol>';
            foreach ($row12 as $key => $value) {
              echo "<li class='p-2'><b>Reviewer Id: </b> " . $value['rid'] . "<b style='padding-left:5%;'>Reviewer Name: </b> " . $value['name'] . "<b style='padding-left:5%;'>Reviewer Email: </b> " . $value['email'] . "</li>";
            }
            echo '</ol>';
            ?>
          </div>
          <div class="form-group">

            <label for="heading" class="pl-1">
              <h5>Reviewer's ID:</h5>
            </label>
            <input type="text" class="form-control" name="rid" id="rid" value="<?php if(isset($_POST['rid'])&&!$insert) echo $_POST['rid']; ?>" />
            <div class="form-check pt-2">
              <input type="checkbox" class="form-check-input" id="rid-show"><span> Click to see the list of reviewers available</span>
            </div>
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1">
              <h5>Department:</h5>
            </label>
            <input type="text" class="form-control" name="dept" id="dept" value="<?php if(isset($_POST['dept'])&&!$insert) echo $_POST['dept']; else echo $_SESSION['admin_dept']; ?>" />
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1">
              <h5>Last Date Of Submission:</h5>
            </label>
            <input type="date" class="form-control" name="last_date_sub" id="last_date_sub" value="<?php if(isset($_POST['last_date_sub'])&&!$insert) echo $_POST['last_date_sub']; ?>"/>
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1">
              <h5>Conference Date:</h5>
            </label>
            <input type="date" class="form-control" name="date_of_conf" id="date-of_conf" value="<?php if(isset($_POST['date_of_conf'])&&!$insert) echo $_POST['date_of_conf']; ?>"/>
          </div>
          <div class="form-row">
            <label for="heading" class="pl-1">
              <h5>Summary:</h5>
            </label>
            <textarea class="form-control" style="min-height: 150px" name="summary" id="summary"><?php if(isset($_POST['summary'])&&!$insert) echo $_POST['summary']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1">
              <h5>Link for image:</h5>
            </label>
            <input type="text" class="form-control" name="image_url" id="image_url" value="<?php if(isset($_POST['image_url'])&&!$insert) echo $_POST['image_url']; ?>"/>
          </div>
          <div class="text-center">
            <input type="submit" class="btn btn-dark" style="margin: auto; width: 50%" id="submit" value="submit" />
          </div>
        </form>
      </div>
      <table id="announcements-list" style="
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
              sans-serif;
          " class="table">
        <thead class="text-center">
          <tr>
            <th>
              <h5>Sno</h5>
            </th>
            <th>
              <h5>Title</h5>
            </th>
            <th>
              <h5>Topic Of Discussion</h5>
            </th>
            <th>
              <h5>Reviewer ID</h5>
            </th>
            <th>
              <h5>Department</h5>
            </th>
            <th>
              <h5>Last Date of Submission</h5>
            </th>
            <th>
              <h5>Conference Date</h5>
            </th>
            <th>
              <h5>Edit</h5>
            </th>
            <th>
              <h5>Cancel</h5>
            </th>
          </tr>
        </thead>

        <tbody class="text-center" style="font-size: large" id="book-list">
          <?php
          $sql = "SELECT * FROM `announcement`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['conf_name'] . "</td>
            <td>" . $row['topic_of_discussion'] . "</td>
            <td>" . $row['rid'] . "</td>
            <td>" . $row['dept'] . "</td>
            <td>" . $row['last_date_sub'] . "</td>
            <td>" . $row['date_of_conf'] . "</td>
          ";
            if ($row['dept'] === $_SESSION['admin_dept']) {
              echo "<td> <button class='edit btn btn-sm'  style='color:blue;' id=" . $row['conf_name'] . "><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
          </svg></button> </td>
            <td> <a href='$_SERVER[PHP_SELF]?conf=$row[conf_name]&topic=$row[topic_of_discussion]' class='btn btn-sm' style='color:red;' id=" . $row['conf_name'] . "><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle' viewBox='0 0 16 16'>
            <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
            <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
          </svg></a></td>
            </tr>";
            } else {
              echo "
              <td></td>
              <td></td>
              </tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </section>
    <div class="">
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit this announcement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="/project-work-2/views/index-admin-home.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="conf_nameEdit" id="conf_nameEdit">
              <input type="hidden" name="topic_of_discussionEdit" id="topic_of_discussionEdit">
              <div class="form-group">
                <label for="rid">Reviewer's ID</label>
                <input type="text" class="form-control" id="ridEdit" name="ridEdit" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="dept">Department</label>
                <input type="text" class="form-control" id="deptEdit" name="deptEdit" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="date_of_conf">Conference Date</label>
                <input type="date" class="form-control" id="date_of_confEdit" name="date_of_confEdit" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="last_date_sub">Last Date Of Submission</label>
                <input type="date" class="form-control" id="last_date_subEdit" name="last_date_subEdit" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="summary">Summary</label>
                <textarea class="form-control" id="summaryEdit" name="summaryEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="text" class="form-control" id="image_urlEdit" name="image_urlEdit" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="modal-footer d-block mr-auto">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div style="margin-bottom: 400px"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit ");
          tr = e.target.parentNode.parentNode.parentNode;
          conf_name = tr.getElementsByTagName("td")[0].innerText;
          topic_of_discussion = tr.getElementsByTagName("td")[1].innerText;
          rid = tr.getElementsByTagName("td")[2].innerText;
          dept = tr.getElementsByTagName("td")[3].innerText;
          last_date_sub = tr.getElementsByTagName("td")[4].innerText;
          date_of_conf = tr.getElementsByTagName("td")[5].innerText;
          console.log(conf_name, topic_of_discussion, rid, dept, last_date_sub, date_of_conf);
          conf_nameEdit.value = conf_name;
          topic_of_discussionEdit.value = topic_of_discussion;
          ridEdit.value = rid;
          deptEdit.value = dept;
          last_date_subEdit.value = last_date_sub;
          date_of_confEdit.value = date_of_conf;
          console.log(e.target.id)
          $('#editModal').modal('toggle');
        })
      })

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("delete ");
          conf_name = e.target.id;

          if (confirm("Are you sure you want to delete this note!")) {
            console.log("yes", e.target.id);
          } else {
            console.log("no");
          }
        })
      });

      let ridShow = document.querySelector('#rid-show');

      ridShow.addEventListener('change', (e) => {
        e.preventDefault();
        let disp = document.getElementById('conf-display');
        if (disp.style.display == 'none') {
          disp.style.display = 'block';
        } else {
          disp.style.display = 'none';
          window.scrollBy(0, -20);
        }
      });
    </script>
  </div>
  <div style="padding-bottom:300px;"></div>
</body>

</html>
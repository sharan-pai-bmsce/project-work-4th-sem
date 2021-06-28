<?php

require('include/header.php');
require('config/database.php');
session_start();
?>

<?php
if (isset($_GET['pid'])) {
    $sql = "SELECT u.first_name,u.last_name,u.email,u.nationality,u.institution,u.mob_no,u.address,s.pid,s.ptitle,s.abstract,s.conf_name,s.topic,s.co_authors,s.file_name,s.file_size,s.status FROM submission s,users u where s.usn=u.usn AND pid=$_GET[pid];";
    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $sql = "SELECT email FROM reviewer WHERE rid='$_SESSION[reviewer_id]';";
    $result = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
}
?>

<title>Submission</title>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>

<body style="background-color: #ccc;">
    <?php
    //echo "$sql";
    if (isset($_POST['Accept'])) {
        //var_dump($_POST);
        $pid = mysqli_real_escape_string($conn, $row1['pid']);
        $sql = "UPDATE submission SET status=1 where pid=$pid;";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location:index-user.php?pid=$row1[pid]");
        }
    }
    if (isset($_GET['file'])) {
        $filename = mysqli_real_escape_string($conn, $_GET['file']);
        echo $filename;
        header('Content-Type: application/octet-stream;charset=utf-8');
        header("Content-Type: application/pdf");
        $filepath = 'Uploads\\' . $filename;
        if (file_exists($filepath)) {
            //echo ;
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Expires: 0');
            header('Content-Transfer-Encoding: binary');
            header('Content-Description: File Transfer');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush();
            ob_clean();
            readfile($filepath);
            exit;
        }
    } ?>
    <?php
    if (isset($_POST))
    ?>
    <div class="container mt-4 p-3" style="background-color: #eee;">
        <?php
    // echo "$sql";
    //var_dump($row1);
    //   echo "<div class></div>";
    //   var_dump($row2);
        ?>
        <div class="form-row pr-4 pl-4">
            <h1 class="text-left col-md-6 pt-4 mt-1" style="font-family: cursive;"><b>Author: </b> <?php echo "$row1[first_name] $row1[last_name]"; ?> </h1>
            <section class="col-md-6">
                <img src="../public/assets/user-profile-pic.jpg" class="float-right" style="border-radius:60rem;width: 120px;" alt="">
            </section>
        </div>
        <hr>
        <br>
        <div class="form-row mb-3 pl-3 pr-3">
            <h4 class="col-md-6"><b>Email: </b> <?php echo "$row1[email]"; ?></h4>
            <h4 class="col-md-6"><b>Mobile No: </b> <?php echo "$row1[mob_no]"; ?> </h4>
        </div>
        <div class="form-row pl-3 pr-3" style="margin-bottom:60px;">
            <h4 class="col-md-4"><b>Institution: </b> <?php echo "$row1[institution]"; ?></h4>
            <h4 class="col-md-4"><b>Nationality: </b> <?php echo "$row1[nationality]"; ?> </h4>
            <h4 class="col-md-4"><b>Address: </b> <?php echo "$row1[address]"; ?> </h4>
        </div>

        <div class="form-row pr-3 pl-3">
            <section class="col-md-2">
                <img src="../public/assets/paper-icon.png" class="float-left" style="width: 120px;" alt="">
            </section>
            <h1 class="text-right col-md-10 mt-4 pt-4" style="font-family: cursive;"><b>Paper Title: </b> <?php echo "$row1[ptitle]"; ?> </h1>
        </div>
        <br>
        <hr>
        <h4 class="mb-3 pl-3"><b>Paper Id: </b> <?php echo "$row1[pid]"; ?></h4>
        <div class="form-row mb-3 pl-3 pr-3s">
            <h4 class="col-md-6"><b>Conference Name: </b> <?php echo "$row1[conf_name]"; ?> </h4>
            <h4 class="col-md-6"><b>Topic: </b> <?php echo "$row1[topic]"; ?> </h4>
        </div>
        <h4 class="mb-3 pl-3"><b>Paper Abstract: </b> <?php echo "$row1[abstract]"; ?></h4>
        <div class="form-row mb-3 pl-3 pr-3">
            <h4 class="col-md-6"><b>File: </b><a class="link-dark" href="index-user.php?pid=<?php echo "$row1[pid]"; ?>&&file=<?php echo "$row1[file_name]"; ?>"><?php echo "$row1[file_name]"; ?></a></h4>
            <?php
            if ($row1['status'] == 0) {
                echo "<h4 class='col-md-6'><b>Approval Status: </b>Not yet Approved</h4>";
            } else {
                echo "<h4 class='col-md-6'><b>Approval Status: </b>Approved</h4>";
            }
            ?>

        </div>
        <br>
        <hr>
        <div class='text-center'>
        <?php if ($row1['status'] == 0) {?>
            <form action="<?php echo "$_SERVER[PHP_SELF]?pid=$row1[pid]" ?>" method='POST' style='display:contents;'>
                <button name='Accept' class='btn btn-success m-2' style='padding-left:12%;padding-right:12%;'>Accept</button>
            </form>
            <button name='Reject' id='reject' class='btn btn-danger m-2' style='padding-left:12%;padding-right:12%;' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Reject</button>
        </div>
        <?php }?>
    </div>
    <div class="m-4 p-4"></div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Recommendations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo "$_SERVER[PHP_SELF]?pid=$row1[pid]" ?>" method="POST">
                        <div class="form-group">
                            <label for="From-Email">From:</label>
                            <h3 name="from" style="background-color:#eee;" class="form-control" id="from"><?php echo "$row2[email]" ?></h3>
                        </div>
                        <div class="form-group">
                            <label for="to-Email">To:</label>
                            <h3 name="to" style="background-color:#eee;" class="form-control" id="to"><?php echo "$row1[email]" ?></h3>
                        </div>
                        <div class="form-group">
                            <label for="ptitle">Paper Title</label>
                            <h3 name="ptitle" class="form-control" style="background-color:#eee;" id="ptitle"><?php echo "$row1[ptitle]" ?></h3>
                        </div>
                        <div class="form-group">
                            <label for="conference">Conference:</label>
                            <h3 name="conf" class="form-control" style="background-color:#eee;" id="conf"><?php echo "$row1[conf_name]-$row1[topic]" ?></h3>
                        </div>
                        <div class="form-group">
                            <label for="Subject">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="subject" value="<?php echo "Your paper has been Rejected" ?>">
                        </div>
                        <div class="form-group">
                            <label for="Recommendations">Suggestion:</label>
                            <textarea name="reco" id="reco" class='form-control' style="height:100px;"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <input name='Send' type="submit" class="col-md-12 btn btn-outline-dark" value="Send">
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['Send'])) {
    var_dump($_POST);
    $from = test_input(mysqli_real_escape_string($conn, $row2['email']));
    $to = test_input(mysqli_real_escape_string($conn, $row1['email']));
    $pid = $row1['pid'];
    $ptitle = test_input(mysqli_real_escape_string($conn, $row1['ptitle']));
    $conference = test_input(mysqli_real_escape_string($conn, "$row1[conf_name]-$row1[topic]"));
    $subject = test_input(mysqli_real_escape_string($conn, $_POST['subject']));
    $suggestion = test_input(mysqli_real_escape_string($conn, $_POST['reco']));
    if (unlink("Uploads/$row1[file_name]")) {
        $sql = "INSERT INTO feedback(from_email,to_email,ptitle,subject,reco,conference) value ('$from','$to','$ptitle','$subject','$suggestion','$conference');";
        echo $sql;
        $result = mysqli_query($conn, $sql);
        echo "$result";
        $sql = "DELETE from submission where pid=$pid;";
        $result = mysqli_query($conn, $sql);
        echo '<script>
            window.opener.location.reload();
            window.close();
            </script>';
    }else{
        echo "Error";
    }


    //header('location:index-reviewer-home.php');
}
?>

</html>
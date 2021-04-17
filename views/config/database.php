<?php
    require('config.php');
    $conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASS,DB_NAME);
    
    //Check Connection
    if(mysqli_connect_errno()){
        echo 'Failed to connect. Please try again later. Error:'.mysqli_connect_errno();
    }

?>
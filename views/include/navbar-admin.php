<div class="header">
    <?php
    session_start();
    if(!$_SESSION['logged_in']){
        header('location: ../views/index-login.php');
    }
    if (isset($_POST['Logout'])) {
        unset($_SESSION['login_user']);
        unset($_SESSION['logged_in']);
        session_destroy();
        header('location: ../views/index-login.php');
    }
    ?>
    <div class="navbar align-items-center pl-3 pr-3" style="background-color: white" id='head'>
        <div class="col-3 pt-2">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png" width="100px" height="100px" />
        </div>
        <div class="col-6 text-center">
            <h3 class="blog-header-logo text-dark pt-2">
                <?php echo ($title); ?>
            </h3>
        </div>
        <div class="col-3 text-right">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <input name="Logout" class="btn btn-outline-secondary" type="submit" value="Log-out">
            </form>
        </div>
    </div>
    <div>
        <nav class="mt-3 navigate navbar navbar-expand-lg pt-2 pb-2 navbar-dark bg-dark" id='navigate-div'>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($path == '/views/index-admin-registration.php') {
                                            echo ('active');
                                        } ?>">
                        <a class="nav-link <?php if ($path == '/views/index-admin-home.php') {
                                                echo ('bg-danger pr-2 pl-2');
                                            } ?>" style="border-radius: 2px" href="../views/index-admin-home.php">HOME</a>
                    </li>
                    <li class="nav-item <?php if ($path == '/views/index-admin-registration.php') {
                                            echo ('active');
                                        } ?>">
                        <a class="nav-link <?php if ($path == '/views/index-admin-registration.php') {
                                                echo ('bg-danger pr-2 pl-2');
                                            } ?>" style="border-radius: 2px" href="../views/index-admin-registration.php">REVIEWER REGISTRATION</a>
                    </li>
                    <li class="nav-item <?php if ($path == '/views/index-admin-registration.php') {
                                            echo ('active');
                                        } ?>">
                      
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<script>
  let nave = document.getElementById('navigate-div');
  document.addEventListener('scroll', (e) => {
    if (window.pageYOffset > 60) {
        console.log(window.pageYOffset);
        document.getElementById('head').style = 'top:-120px;'
        nave.style = 'top:-20px;';

    } else {
        document.getElementById('head').style = 'top:0px;background-color:white;'
        document.getElementById('navigate-div').style = 'top:105px;';
    }
  });
</script>
 <div class="header">
    <div class="navbar align-items-center pl-3 pr-3" style="background-color: white">
        <div class="col-3 pt-2">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png" width="100px" height="100px" />
        </div>
        <div class="col-6 text-center">
            <h3 class="blog-header-logo text-dark pt-2">
                <?php echo($title);?>
            </h3>
        </div>
        <div class="col-3 text-right">
            <a href="../views/index-login.php" id="log-out" class="btn btn-outline-secondary pt-2">Logout</a>
        </div>
    </div>
    <div>
        <nav class="mt-3 navigate navbar navbar-expand-lg pt-2 pb-2 navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($path == '/views/index-admin-submission.php') {echo ('active');} ?>">
                        <a class="nav-link <?php if ($path == '/views/index-admin-home.php') {echo ('bg-danger pr-2 pl-2');} ?>" style="border-radius: 2px" href="../views/index-admin-home.php">Home</a>
                    </li>
                    <li class="nav-item <?php if ($path == '/views/index-admin-submission.php') {echo ('active');} ?>">
                        <a class="nav-link <?php if ($path == '/views/index-admin-submission.php') {echo ('bg-danger pr-2 pl-2');} ?>" style="border-radius: 2px" href="../views/index-admin-submission.php">Submissions</a>
                    </li>
                    <li class="nav-item <?php if ($path == '/views/index-admin-submission.php') {echo ('active');} ?>">
                        <a class="nav-link <?php if ($path == '/views/index-admin-contact.php') {echo ('bg-danger pr-2 pl-2');} ?>" style="border-radius: 2px" href="../views/index-admin-contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
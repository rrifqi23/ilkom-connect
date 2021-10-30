<header>
    <nav class="navbar navbar-expand-sm navbar-light pt-3 pb-2 pb-md-4">
        <ul class="navbar-nav">
            <a class="navbar-brand" href="index.php">
                <h3 class="display-6 text-primary pl-sm-5 pl-2"><i class='text-primary fas fa-user-plus'></i> Ilkom Connect</h3>
            </a>
        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon text-primary"><i class='fad fa-menu'></i></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="nav navbar-nav d-block">
                <li class="nav-item mr-5 d-inline-block">
                    <a class="nav-link text-primary" href="#">Student List</a>
                </li>
                <li class="nav-item mr-5 d-inline-block">
                    <a class="nav-link text-primary" href="#">About</a>
                </li>
                <?php if (!isset($_SESSION['loggedin'])) {?>
                <li class="nav-item mr-5 d-inline-block">
                    <a class="nav-link btn btn-primary text-white px-3" href="login.php">Sign in</a>
                </li>
                <?php } else {?>
                <li class="nav-item dropdown mr-5 d-inline-block">
                    <a class="nav-link dropdown-toggle text-primary" data-toggle="dropdown" id="navbardrop" href="#">
                        <span class="text-primary font-weight-bolder"><?php echo $_SESSION['username']?></span>
                        <img class="rounded-circle ml-1" style="max-height: 40px" src=<?php echo $_SESSION['imgUrl']?>>
                    </a>
                    <div class="dropdown-menu shadow border-0 rounded">
                        <a class="dropdown-item text-primary" href="profile.php">View profile</a>
                        <a class="dropdown-item text-primary" href="logout.php">Sign out</a>
                    </div>
                </li>
                <?php }?>
            </ul>
        </div>
    </nav>
</header>

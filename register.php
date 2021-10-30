<?php
session_start();

if (!isset($_SESSION["nameVal"])) {
    $_SESSION["nameVal"] = "";
}

if (!isset($_SESSION["usernameVal"])) {
    $_SESSION["usernameVal"] = "";
}

if (!isset($_SESSION["emailVal"])) {
    $_SESSION["emailVal"] = "";
}

if (!isset($_SESSION["passwordVal"])) {
    $_SESSION["passwordVal"] = "";
}

if (!isset($_SESSION["confirmPasswordVal"])) {
    $_SESSION["confirmPasswordVal"] = "";
}

?>

<html>
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    </head>
    
    <body class="bg-light">
    <div class="container text-center pt-5">
        <a href="index.php" class="display-4 text-decoration-none text-primary"><i class='text-primary fas fa-user-plus'></i> Ilkom Connect</a>
        <h6 class="display-5 pt-2 pb-4">Register to Ilkom Connect</h6>
    </div>
    <?php if (isset($_SESSION['loginErrMsg'])) {?>
        <div class="container-fluid">
            <div class="alert btn-secondary">
                <?php echo $_SESSION['loginErrMsg']; unset($_SESSION['loginErrMsg']);?>
                <p id="alert"></p>
                <a href="#" class="close text-white" data-dismiss="alert">&times;</a>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="container col-11 col-md-5 justify-content-center">
            <form action="authenticate.php" method="post">
                <fieldset class="container shadow card border-0 py-3">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-user-alt"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo $_SESSION["nameVal"] ?>" name="nama" placeholder="Nama" id="nama" aria-describedby="namaHelpBlock" required>
                        </div>
                        <small id="nameHelpBlock" class="form-text text-muted">
                            Nama hanya boleh berisi huruf (a-z), titik, dan koma
                        </small>
                        <div class="invalid-feedback">
                            Nama tidak valid
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo $_SESSION["usernameVal"] ?>" name="username" placeholder="Username" id="username" aria-describedby="usernameHelpBlock" required>
                        </div>
                        <small id="usernameHelpBlock" class="form-text text-muted">
                            Username hanya boleh berisi huruf, angka, dan/atau underscore (_)
                        </small>
                        <div class="invalid-feedback">
                            <?php if (!isset($_SESSION["usernameAlreadyUsed"])) {?>
                                Username tidak valid;
                            <?php } else {?>
                                Username telah digunakan;
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-at"></i></span>
                            </div>
                            <input type="email" class="form-control <?php echo $_SESSION["emailVal"] ?>" name="email" placeholder="Email" id="email" required>
                        </div>
                        <small id="usernameHelpBlock" class="form-text text-muted">
                            Email harus valid dan aktif
                        </small>
                        <div class="invalid-feedback">
                            Email tidak valid
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control <?php echo $_SESSION["passwordVal"] ?>" name="password" placeholder="Password" id="password" aria-describedby="passwordHelpBlock" required>
                        </div>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Password harus minimal 8 karakter, mengandung angka (0-9) dan huruf kapital. Tidak boleh ada spasi
                        </small>
                        <div class="invalid-feedback">
                            Password tidak valid
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control <?php echo $_SESSION["confirmPasswordVal"]?> " name="confirmPassword" placeholder="Confirm Password" id="confirmPassword" aria-describedby="confirmPasswordHelpBlock" required>
                        </div>
                        <small id="confirmPasswordHelpBlock" class="form-text text-muted">
                            Konfirmasi Password
                        </small>
                        <div class="invalid-feedback">
                            Password tidak sama
                        </div>
                    </div>
                    <div class="container-fluid text-sm-right text pt-5">
                        <button type="submit" name="register" class="btn btn-primary">
                            Register
                        </button>
                        <a class="pl-3 text-decoration-none text-secondary" href="index.php">kembali ke main menu</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </main>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>

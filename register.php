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
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body class="bg-light">
    <div class="container text-center pt-5">
        <a href="index.php" class="display-4 text-decoration-none text-primary"><i class='text-primary fas fa-user-plus'></i> Ilkom Connect</a>
        <h6 class="display-5 pt-2 pb-4">Register to Ilkom Connect</h6>
    </div>

    <main class="row" style="max-width: 100%">
        <?php if (isset($_SESSION['registerErrMsg'])) {?>
            <div class="container">
                <div class="alert btn-secondary">
                    <?php echo $_SESSION['registerErrMsg']; unset($_SESSION['registerErrMsg']);?>
                    <a href="#" class="close text-white" data-dismiss="alert">&times;</a>
                </div>
            </div>
        <?php } ?>
        <div class="container col-11 col-md-5 justify-content-center">
            <form action="authenticate.php" method="post">
                <fieldset class="container shadow card border-0 py-3">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-user-alt"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo $_SESSION["nameVal"] ?>"
                                   name="nama" placeholder="Nama" id="nama"
                                   data-toggle="tooltip" title="Nama hanya boleh berisi huruf (a-z), titik, dan koma" required>
                            <div class="invalid-feedback">
                                Nama tidak valid
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo $_SESSION["usernameVal"] ?>" name="username"
                                   placeholder="Username" id="username" data-toggle="tooltip"
                                   title="Username hanya dapat mengandung huruf, angka, titik, dan/atau underscore (_)" required>
                            <div class="invalid-feedback">
                                <?php if (!isset($_SESSION["usernameAlreadyUsed"])) {?>
                                    Username tidak valid;
                                <?php } else {?>
                                    Username telah digunakan;
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-at"></i></span>
                            </div>
                            <input type="email" class="form-control <?php echo $_SESSION["emailVal"] ?>"
                                   name="email" placeholder="Email" id="email" data-toggle="tooltip"
                                   title="Email harus valid dan aktif" required>
                            <div class="invalid-feedback">
                                <?php if (!isset($_SESSION["emailAlreadyUsed"])) {?>
                                    Email tidak valid;
                                <?php } else {?>
                                    Email telah digunakan;
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control <?php echo $_SESSION["passwordVal"] ?>"
                                   name="password" placeholder="Password" id="password" data-toggle="tooltip"
                                   title="Password harus minimal 8 karakter, mengandung angka (0-9) dan huruf kapital. Tidak boleh ada spasi" required>
                            <div class="invalid-feedback">
                                Password tidak valid
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary"><i class="text-white fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control <?php echo $_SESSION["confirmPasswordVal"]?> "
                                   name="confirmPassword" placeholder="Confirm Password" id="confirmPassword" data-toggle="tooltip"
                                   title="Konfirmasi Password" required>
                            <div class="invalid-feedback">
                                Password tidak sama
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid text-sm-right text pt-5">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#konfirmasi">
                            Register
                        </button>
                        <a class="pl-3 text-decoration-none text-secondary" href="index.php">kembali ke main menu</a>
                    </div>
                    <div class="modal fade" id="konfirmasi">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Konfirmasi Register</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="register" class="btn btn-primary">Ya</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </main>

    <?php
        unset($_SESSION["nameVal"]);
        unset($_SESSION["usernameVal"]);
        unset($_SESSION["usernameAlreadyUsed"]);
        unset($_SESSION["emailVal"]);
        unset($_SESSION["usernameAlreadyUsed"]);
        unset($_SESSION["passwordVal"]);
        unset($_SESSION["confirmPasswordVal"]);
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    </body>
</html>

<?php
session_start();
?>

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    </head>

    <body class="bg-light">
            <div class="container text-center pt-5">
                <a href="index.php" class="display-4 text-decoration-none text-primary"><i class='text-primary text-white fas fa-user-plus'></i> Ilkom Connect</a>
                <h6 class="display-5 pt-2 pb-4">Sign in to Ilkom Connect</h6>
            </div>
            <div class="row">
                <div class="container col-11 col-md-4 justify-content-center">
                    <?php if (isset($_SESSION['loginErrMsg'])) {?>
                        <div class="container-fluid">
                            <div class="alert btn-secondary">
                                <?php echo $_SESSION['loginErrMsg']; unset($_SESSION['loginErrMsg']);?>
                                <a href="#" class="close text-white" data-dismiss="alert">&times;</a>
                            </div>
                        </div>
                    <?php } ?>
                    <form action="authenticate.php" method="post">
                        <fieldset class="container shadow card border-0 py-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white"><i class="text-white fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="username" placeholder="Username" id="username" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white"><i class="text-white fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
                            </div>
                            <div class="container-fluid text-right text pt-5">
                                <button type="submit" name="login" class="btn btn-primary">
                                    Sign in
                                </button>
                                <a class="pl-3 text-decoration-none" href="register.php">Register</a>
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

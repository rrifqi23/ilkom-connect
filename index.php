<?php
session_start();

?>

<html>
    <head>
        <title>Ilkom Connect</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body class="bg-light">

        <?php include "header.php"?>

        <main class="mx-auto" style="max-width: 90%">
`           <div class="row pb-5 pt-1 pt-lg-3">
                <section class="col-lg-6 order-2 order-lg-1 my-auto">
                    <div class="container">
                        <?php if (!isset($_SESSION['loggedin'])) {?>
                            <h1 class="display-4">Welcome, Ilkomers!</h1>
                            <p class="font-weight-normal">
                                Ilkom Connect adalah website yang berisi kontak para mahasiswa
                                fasilkom unsri yang telah memiliki akun di website ini.
                                Website ini akan terus dikembangkan agar dapat memiliki fitur chat
                                sehingga antar akun dapat berkomunikasi satu sama lain.
                            </p>
                            <div class="row align-items-center pt-3">
                                <div class="col-12 col-lg-5 pb-3 pb-lg-0">
                                    <button onclick="document.location='login.php'" type="button" class="btn btn-primary btn-lg w-100">
                                        Sign in
                                    </button>
                                </div>
                                <div class="col-lg-7 align-items-center h-100">
                                    <span class="align-self-center">
                                        atau<a class="ml-1 ml-lg-3 text-primary" href="register.php">Buat akun</a>
                                    </span>
                                </div>
                            </div>
                        <?php } else {?>
                            <h1 class="display-4">Welcome, <?php echo $_SESSION['nama']?></h1>
                            <p class="font-weight-light">
                                Anda berhasil masuk dan terhubung dengan Ilkom Connect! anda dapat
                                menggunakan website ini untuk melihat kontak para mahasiswa
                                fasilkom unsri yang telah memiliki akun di website ini dan/atau melihat
                                data anda sendiri serta mengeditnya!
                            </p>
                            <div class="row">
                                <div class="col-12 col-lg-5 pt-3">
                                    <button onclick="document.location='profile.php'" type="button" class="btn btn-primary btn-lg w-100">
                                        Profile anda
                                    </button>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </section>
                <section class="col-lg-6 order-1 order-lg-2">
                    <div class="container py-5 py-lg-0">
                        <img class="img-fluid" id="home_img" src="assets/socimg.png" alt="social interaction image">
                    </div>
                </section>
            </div>
        </main>

        <?php include "footer.php"?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="smoothscroll.js"></script>
        <script>
            <script>
                $(document).ready(function(){
                $("a").on('click', function(event) {
                    if (this.hash !== "") {
                        event.preventDefault();
                        var hash = this.hash;

                        $('html, body').animate({scrollTop: $(hash).offset().top}, 800, function(){
                            window.location.hash = hash;
                        });
                    }
                });
            });
        </script>
        </script>
    </body>
</html>
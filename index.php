<?php
session_start();

$_SESSION['imgUrl'] = "pfp/pfp.jpg"; // Inisialisasi untuk direktori gambar
?>

<html>
    <head>
        <title>Ilkom Connect</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    </head>

    <body class="bg-light">

        <?php include "header.php"?>

        <main class="mx-auto" style="max-width: 90%">
`           <div class="row pb-5">
                <section class="col-md-6 my-auto">
                    <div class="container">
                        <?php if (!isset($_SESSION['loggedin'])) {?>
                            <h1 class="display-4">Welcome, Ilkomers!</h1>
                            <p>
                                Ilkom Connect adalah website yang berisi kontak para mahasiswa
                                fasilkom unsri yang telah memiliki akun di website ini.
                                Website ini akan terus dikembangkan agar dapat memiliki fitur chat
                                sehingga antar akun dapat berkomunikasi satu sama lain.
                            </p>
                            <div class="row align-items-center pt-3">
                                <div class="col-12 col-md-5">
                                    <button onclick="document.location='login.php'" type="button" class="btn btn-primary btn-lg w-100">
                                        Sign in
                                    </button>
                                </div>
                                <div class="col-md-7 align-items-center h-100 pt-2 pt-md-0">
                                    <span class="align-self-center">
                                        atau<a class="ml-1 ml-md-3 text-primary" href="register.php">Buat akun</a>
                                    </span>
                                </div>
                            </div>
                        <?php } else {?>
                            <h1 class="display-4">Welcome, <?php echo $_SESSION['username']?></h1>
                            <p>
                                Anda berhasil masuk dan terhubung dengan Ilkom Connect! anda dapat
                                menggunakan website ini untuk melihat kontak para mahasiswa
                                fasilkom unsri yang telah memiliki akun di website ini dan/atau melihat
                                data anda sendiri serta mengeditnya!
                            </p>
                            <div class="row">
                                <div class="col-12 col-md-5 pt-3">
                                    <button onclick="document.location='profile.php'" type="button" class="btn btn-primary btn-lg w-100">
                                        Profile anda
                                    </button>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </section>
                <section class="col-md-6">
                    <div class="container pt-5 pt-md-0">
                        <img class="img-fluid" id="home_img" src="assets/socimg.png" alt="social interaction image">
                    </div>
                </section>
            </div>
        </main>

        <?php include "footer.php"?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
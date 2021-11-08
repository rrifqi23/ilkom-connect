<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ilkom_connect_db';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->query('SELECT nama, nama_file_foto, kampus, jurusan, tahun_angkatan, username FROM accounts ORDER BY nama');

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
            <section class="container pl-lg-3 pt-2 pb-3">
                <h3>Student List</h3>
                <small>Daftar mahasiswa fasilkom yang telah mendaftar di situs ini</small>
            </section>
            <?php while ($acc_data = $stmt->fetch_array()) {?>
            <div class="media border p-4 mx-auto" style="max-width: 800px">
                <img src="<?php echo $acc_data['nama_file_foto']?>" class="d-none d-lg-block align-self-lg-center rounded-circle" style="width:20%;">
                <div class="media-body ml-4">
                    <img src="<?php echo $acc_data['nama_file_foto']?>" class="d-block d-lg-none pb-2 rounded-circle" style="width:40%;">
                    <h4><?php echo $acc_data['nama']?></h4>
                    <h6 class="text-muted">@<?php echo $acc_data['username']?></h6>
                    <table class="table table-striped">
                        <tr>
                            <td>Kampus</td>
                            <td><?php echo $acc_data['kampus']?></td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td><?php echo $acc_data['jurusan']?></td>
                        </tr>
                        <tr>
                            <td>Tahun Angkatan</td>
                            <td><?php echo $acc_data['tahun_angkatan']?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php } ?>
        </main>

        <?php include "footer.php"?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="smoothscroll.js"></script>
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
    </body>
</html>
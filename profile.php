<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Fungsi menformat bulan angka jadi nama bulannya
function profile_date_format($date){
    $date_month = date('m',strtotime($date)); // Mengambil nilai bulan
    $all_month =
        array("Januari", "Februari", "Maret" ,"April" ,"Mei" ,"Juni",
        "Juli","Agustus","September","Oktober","November","Desember"); // daftar nama bulan berurutan

    $day = date('d',strtotime($date)); // Mengambil nilai hari
    $month = $all_month[$date_month - 1]; // Mengambil nama bulan berdasarkan nilai bulan - 1
    $year = date('Y',strtotime($date)); // Mengambil nilai tahun

    return $day . " " . $month . " " . $year;
}


// Memasukkan tanggal terformat ke variabel tl
$tl = profile_date_format($_SESSION['tl']);

// Array data di kolom kiri
$data_left = array(
    "Nama" => $_SESSION['nama'],
    "Tempat Tanggal Lahir" => $_SESSION['bp']. ", " . $tl,
    "Jenis Kelamin" => $_SESSION['sex'],
    "Nomor Telepon" => $_SESSION['phonenum'],
    "Alamat" => $_SESSION['address']
);

// Array data di kolom kanan
$data_right = array(
    "NIM" => $_SESSION['nim'],
    "Email" => $_SESSION['email'],
    "Tahun Angkatan" => $_SESSION['t_angk'],
    "Jurusan" =>  $_SESSION['jurusan'],
    "Kampus" => $_SESSION['kampus']
);
?>

<html>
    <head>
        <title>Profil Anda</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body class="bg-light">

        <?php include "header.php"?>

        <?php if (isset($_SESSION['updated'])) { ?> <!--Jika nilainya diset maka dimunculkan-->
        <div class="container">
            <div class="alert btn-primary">
                Profil berhasil di update
                <a href="#" class="close text-white" data-dismiss="alert">&times;</a>
            </div>
        </div><?php unset($_SESSION['updated']);} ?>
		
        <main class="row mx-auto" style="max-width: 90%">
            <section class="container pl-lg-3 py-3">
                <h3>Profile</h3>
            </section>
			<aside class="col-9 col-md-5 mx-auto col-lg-4 col-xl-3">
                <section class="container shadow card border-0 pb-3 pt-3">
                    <img onerror="this.onerror=null; this.src='pfp/blank.png'" src=<?php echo $_SESSION['imgUrl']?>>
                </section><br>
            </aside>
            <article class="col-lg-8 col-xl-9 shadow bg-white pt-3 pb-4">
                <div class="row">
                    <section class="col-lg-6">
                        <?php // Melakukan Loop untuk menampilkan data kiri
                        foreach($data_left as $term => $term_value) { ?>
							<div class="form-group">
								<label><?php echo $term ?></label>
								<span class="container card py-2"><?php echo $term_value?></span>
							</div>
                        <?php } ?>
                    </section>
                    <section class="col-lg-6">
                        <?php // Melakukan Loop untuk menampilkan data kanan
                        foreach($data_right as $term => $term_value) { ?>
							<div class="form-group">
								<label><?php echo $term ?></label>
								<span class="container card py-2"><?php echo $term_value?></span>
							</div>
                        <?php } ?>
                    </section>
                </div>
            </article>

            <div class="w-100 text-right row justify-content-end mx-auto pt-5">
                <div class="col-lg-2">
                    <button onclick="document.location='profile_update.php'" type="button" class="w-100 btn btn-primary">
                        <i class='text-white fas fa-edit'></i>&nbsp; Edit Profile
                    </button>
                </div>
                <div class="row mx-auto mx-lg-0 col-lg-2 pt-4 pt-lg-0 align-self-center">
                    <a class="col text-decoration-none text-center text-secondary" href="index.php">kembali ke menu</a>
                </div>
            </div>
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
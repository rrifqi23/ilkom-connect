<?php
session_start();

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

// Inisialisasi Awal
if ($_SESSION == null) {
    $_SESSION['nama'] = "Muhammad Rifqi Ramadhan"; // Nama
    $_SESSION['nim'] = "09021182025028"; // Nim
    $_SESSION['bp'] = "Palembang"; // Tempat Lahir (Birthplace)
    $_SESSION['tl'] = "23-11-2002"; // Tanggal Lahir
    $_SESSION['sex'] = "Laki-Laki"; // Jenis-Kelamin
    $_SESSION['t_angk'] = 2020; // Tahun Angkatan
    $_SESSION['address'] = "jl. Perintis Raya Blok N-10 No.4"; // Alamat
    $_SESSION['jurusan'] = "Teknik Informatika"; // Jurusan
    $_SESSION['kampus'] = "Indralaya"; // Kampus
    $_SESSION['email'] = "mrifqiramadhan2002@gmail.com"; // Email
    $_SESSION['phonenum'] = "081373668830"; // Nomor Telepon

    $_SESSION['imgErr'] = ""; // Inisialisasi untuk pessan error pada penguploadan gambar
    $_SESSION['imgUrl'] = "pfp/pfp.jpg"; // Inisialisasi untuk direktori gambar
    $_SESSION['updated'] = 0; // nilai untuk mentrigger pesan bahwa profile sudah diupdate
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
        <title>Profil Mahasiswa</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    </head>

    <body class="bg-light">

        <?php include "header.php"?>
		
        <main class="row mx-auto" style="max-width: 90%">
            <section class="container pl-sm-3 py-3">
                <h3>Profil Mahasiswa</h3>
            </section>
            <?php if (isset($_SESSION['updated'])) { ?> <!--Jika nilainya diset maka dimunculkan-->
            <div class="container-sm fixed-bottom mr-3 mb-4" style="max-width: 350px">
                <div class="alert btn-primary">
                    Profil berhasil di update
                    <a href="#" class="close text-white" data-dismiss="alert">&times;</a>
                </div>
            </div><?php unset($_SESSION['updated']);} ?>
			<aside class="col-sm-3">
                <section class="container shadow card border-0 pb-3 pt-3">
                    <img onerror="this.onerror=null; this.src='pfp/blank.png'" src=<?php echo $_SESSION['imgUrl'] . "?=" . filemtime($_SESSION['imgUrl']) ?>>
                </section><br>
            </aside>
            <article class="col-sm-9 shadow bg-white pt-3 pb-4">
                <div class="row">
                    <section class="col-sm-6">
                        <?php // Melakukan Loop untuk menampilkan data kiri
                        foreach($data_left as $term => $term_value) { ?>
							<div class="form-group">
								<label><?php echo $term ?></label>
								<span class="container card py-2"><?php echo $term_value?></span>
							</div>
                        <?php } ?>
                    </section>
                    <section class="col-sm-6">
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
            <div class="container-fluid text-right pt-5">
                <button onclick="document.location='profile_update.php'" type="button" class="btn btn-primary">
                    <i class='fas fa-edit'></i>&nbsp; Edit Profile
                </button>
            </div>
        </main>

        <?php include "footer.php"?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
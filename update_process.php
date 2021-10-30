<?php
session_start();

if (isset($_POST['submit'])) {
	$_SESSION['nama'] = $_POST['nama'];
    $_SESSION['nim'] = $_POST['nim'];
    $_SESSION['bp'] = $_POST['bp'];
    $_SESSION['tl'] = $_POST['tl'];
    $_SESSION['sex'] = $_POST['sex'];
    $_SESSION['angk'] = $_POST['t_angk'];
    $_SESSION['jurusan'] = $_POST['jurusan'];
    $_SESSION['kampus'] = $_POST['kampus'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phonenum'] = $_POST['phonenum'];
    $_SESSION['address'] = $_POST['address'];

    if ($_FILES['photo']['name'] != null) {
		$check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check === false) {
            $_SESSION['imgErr'] = "File ini bukan gambar";
            header("Location: profile_update.php");
            exit();
        }

        if (($_FILES["photo"]["size"] / 1024) > 1024) {
            $_SESSION['imgErr'] = "Ukuran Foto anda terlalu besar";
            header("Location: profile_update.php");
            exit();
        }
		
		unlink($_SESSION['imgUrl']);
		
		$imageFileType = strtolower(pathinfo("pfp/". basename($_FILES["photo"]["name"]),PATHINFO_EXTENSION));
		$_SESSION['imgUrl'] = "pfp/pfp." . $imageFileType;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $_SESSION['imgUrl'])) {
			$_SESSION['imgErr'] = "Terdapat error saat mengupload foto.";
		}

    }
	
	$_SESSION['updated'] = 1;

    header("Location: profile.php");
    exit();

} elseif (isset($_POST['cancel'])) {
    header("Location: profile.php");
    exit();
}

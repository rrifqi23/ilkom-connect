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

if (isset($_POST['submit'])) {

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] != UPLOAD_ERR_NO_FILE) {
        if ($_FILES['photo']['name'] != null) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check === false) {
                $_SESSION['imgErr'] = "File ini bukan gambar";
                header("Location: profile_update.php");
                exit();
            }
        }

        if (($_FILES["photo"]["size"] / 1024) > 1024) {
            $_SESSION['imgErr'] = "Ukuran Foto anda terlalu besar";
            header("Location: profile_update.php");
            exit();
        }

        $imageFileType = strtolower(pathinfo("pfp/". basename($_FILES["photo"]["name"]),PATHINFO_EXTENSION));
        $_SESSION['imgUrl'] = "pfp/" . $_SESSION['id'] . "." . $imageFileType;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $_SESSION['imgUrl'])) {
			$_SESSION['imgErr'] = "Terdapat error saat mengupload foto.";
            header("Location: profile_update.php");
            exit();
		} else {
            if ($stmt = $con->prepare('UPDATE accounts SET nama_file_foto = ? WHERE account_id = ?;')) {
                $stmt->bind_param('si', $_SESSION['imgUrl'], $_SESSION['id']);
                $stmt->execute();

                $stmt->close();

                $_SESSION['imgUrl'] = $_SESSION['imgUrl'] . "?=" . filemtime($_SESSION['imgUrl']);
            } else {
                $_SESSION['imgErr'] = "Terdapat error saat mengupload foto.";
                header("Location: profile_update.php");
                exit();
            }
        }
    }

    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['nim'] = $_POST['nim'];
    $_SESSION['bp'] = $_POST['bp'];
    $_SESSION['tl'] = $_POST['tl'];
    $_SESSION['sex'] = $_POST['sex'];
    $_SESSION['t_angk'] = $_POST['t_angk'];
    $_SESSION['jurusan'] = $_POST['jurusan'];
    $_SESSION['kampus'] = $_POST['kampus'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phonenum'] = $_POST['phonenum'];
    $_SESSION['address'] = $_POST['address'];

    if ($stmt = $con->prepare(
        'UPDATE accounts SET nama = ?, nim = ?, email = ?, tempat_lahir = ?, tanggal_lahir = ?, jenis_kelamin = ?,
            no_telpon = ?, alamat = ?, tahun_angkatan = ?, jurusan = ?, kampus = ? WHERE account_id = ?;'
    )) {
        $stmt->bind_param('ssssssssissi',
            $_POST['nama'], $_POST['nim'], $_POST['email'], $_POST['bp'], $_POST['tl'], $_POST['sex'], $_POST['phonenum'],
            $_POST['address'], $_POST['t_angk'], $_POST['jurusan'], $_POST['kampus'], $_SESSION['id']);
        $stmt->execute();
    }

    $stmt->close();
	
	$_SESSION['updated'] = 1;

    header("Location: profile.php");
    exit();

} elseif (isset($_POST['cancel'])) {
    header("Location: profile.php");
    exit();
}

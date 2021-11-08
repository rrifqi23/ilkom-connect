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

if (isset($_POST['login'])) {
    if ($stmt = $con->prepare('SELECT * FROM `accounts` WHERE `username` = ?;')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();

        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($account_id, $username, $password, $nama, $email, $nim, $tempat_lahir,
                $tanggal_lahir, $jenis_kelamin, $no_telpon, $alamat, $tahun_angkatan, $jurusan, $kampus, $nama_file_foto);
            $stmt->fetch();

            if (password_verify($_POST['password'], $password)) {

                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['id'] = $account_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['nama'] = $nama;
                $_SESSION['nim'] = $nim;
                $_SESSION['bp'] = $tempat_lahir; // Tempat Lahir (Birthplace)
                $_SESSION['tl'] = $tanggal_lahir; // Tanggal Lahir
                $_SESSION['sex'] = $jenis_kelamin; // Jenis-Kelamin
                $_SESSION['t_angk'] = $tahun_angkatan; // Tahun Angkatan
                $_SESSION['address'] = $alamat; // Alamat
                $_SESSION['jurusan'] = $jurusan; // Jurusan
                $_SESSION['kampus'] = $kampus; // Kampus
                $_SESSION['phonenum'] = $no_telpon; // Nomor Telepon
                $_SESSION['imgUrl'] = $nama_file_foto . "?=" . filemtime($nama_file_foto);

                header('Location: index.php');
            } else {
                $_SESSION['loginErrMsg'] = "Username dan/atau password salah";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['loginErrMsg'] = "Username dan/atau password salah";
            header("Location: login.php");
            exit();
        }
    $stmt->close();
    }

} else if (isset($_POST['register'])) {
    unset($_SESSION["nameVal"]);
    unset($_SESSION["usernameVal"]);
    unset($_SESSION["emailVal"]);
    unset($_SESSION["passwordVal"]);
    unset($_SESSION["confirmPasswordVal"]);
    $isInvalidExist = false;

    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["nama"])){
        $_SESSION["nameVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["nameVal"] = "is-valid";
    }

    if (!preg_match("/^[0-9a-zA-Z_.]*$/", $_POST["username"])){
        $_SESSION["usernameVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["usernameVal"] = "is-valid";
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $_SESSION["emailVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["emailVal"] = "is-valid";
    }

    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST["password"])){
        $_SESSION["passwordVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["passwordVal"] = "is-valid";
    }

    if ($_POST["password"] !== $_POST["confirmPassword"]){
        $_SESSION["confirmPasswordVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["confirmPasswordVal"] = "is-valid";
    }

    if ($stmt = $con->prepare('SELECT `username` FROM `accounts` WHERE `username` = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->fetch();

        $_SESSION['usr'] = $_POST['username'];
        $_SESSION['qusr'] = $username;

        $stmt->close();
    }

    if ($stmt = $con->prepare('SELECT `email` FROM `accounts` WHERE `email` = ?')) {
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->fetch();

        $_SESSION['em'] = $_POST['email'];
        $_SESSION['qem'] = $email;

        $stmt->close();
    }

    if ($username !== $_POST['username'] && $email !== $_POST['email'] && $username == null && $email == null) {
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($stmt = $con->prepare(
            'INSERT INTO accounts (`nama`, `email`, `username`, `password`) VALUES (?, ?, ?, ?);')) {
            $stmt->bind_param('ssss', $_POST['nama'], $_POST['email'], $_POST['username'], $hashed_password);
            $stmt->execute();

            $stmt->close();

            if ($stmt = $con->prepare(
                'SELECT `account_id` FROM `accounts` WHERE `username` = ?')) {
                $stmt->bind_param('s', $_POST['username']);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();

                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['nama'] = $_POST['nama'];

                $_SESSION['nim'] = ""; // Nim
                $_SESSION['bp'] = ""; // Tempat Lahir (Birthplace)
                $_SESSION['tl'] = ""; // Tanggal Lahir
                $_SESSION['sex'] = ""; // Jenis-Kelamin
                $_SESSION['t_angk'] = 2006; // Tahun Angkatan
                $_SESSION['address'] = ""; // Alamat
                $_SESSION['jurusan'] = ""; // Jurusan
                $_SESSION['kampus'] = ""; // Kampus
                $_SESSION['phonenum'] = ""; // Nomor Telepon

                $_SESSION['imgUrl'] = "pfp/blank.png"; // Inisialisasi untuk direktori gambar

                $stmt->close();
                header('Location: index.php');

            } else {
                $_SESSION['registerErrMsg'] = "Registrasi gagal dilakukan";
                header("Location: register.php");
                exit();
            }
        } else {
            $_SESSION['registerErrMsg'] = "Registrasi gagal dilakukan";
            header("Location: register.php");
            exit();
        }

    } else {
        if ($username == $_POST['username']) {
            $_SESSION["usernameVal"] = "is-invalid";
            $_SESSION["usernameAlreadyUsed"] = true;
            $isInvalidExist = true;
        }

        if ($email == $_POST['email']) {
            $_SESSION["emailVal"] = "is-invalid";
            $_SESSION["emailAlreadyUsed"] = true;
            $isInvalidExist = true;
        }
    }

    if ($isInvalidExist){
        header("Location: register.php");
        exit();
    }

}



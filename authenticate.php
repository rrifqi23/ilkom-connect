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
    if ($stmt = $con->prepare('SELECT nim, password FROM accounts WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();

        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($nim, $password);
            $stmt->fetch();

            if (password_verify($_POST['password'], $password)) {

                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id'] = $nim;

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

    if (!preg_match("[a-zA-Z-'., ]*$", $_POST["nama"])){
        $_SESSION["nameVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["nameVal"] = "is-valid";
    }

    if (!preg_match("[a-zA-Z_]*$", $_POST["username"])){
        $_SESSION["usernameVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["usernameVal"] = "is-valid";
    }

    if (!preg_match("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $_POST["email"])){
        $_SESSION["emailVal"] = "is-invalid";
        $isInvalidExist = true;
    } else {
        $_SESSION["emailVal"] = "is-valid";
    }

    if (!preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$", $_POST["password"])){
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

    if ($isInvalidExist){
        header("Location: register.php");
        exit();

    } else {
        if ($stmt = $con->prepare('SELECT username FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();

            $stmt->store_result();
            if ($stmt->num_rows = 0) {
                $stmt->bind_result($username);
                $stmt->fetch();

                $stmt = $con->prepare('INSERT nim, username, password, email FROM accounts');

            } else {
                $_SESSION['loginErrMsg'] = "Username telah digunakan";
                header("Location: register.php");
                exit();
            }
        }
    }

}



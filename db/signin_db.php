<?php
require_once "connect.php";
session_start();
$login = isset($_POST['login']) ? $_POST['login'] : false;
$pass = isset($_POST['pass']) ? $_POST['pass'] : false;


if ($login && $pass) {
    $db = "SELECT * FROM `users` WHERE username ='$login'";
    $result = mysqli_query($con, $db);

    if (mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($pass, $user["password_hash"])) {
            $_SESSION["id"] = $user["id"];

            $_SESSION['success_message'] = 'Авторизация прошла успешно!';
            header("Location:/");

        } else {
            $_SESSION['success_message'] = 'Пароль неверный';
            header("Location:/sign.php");

        }

    } else {
        $_SESSION["success_message"] = "Неверное имя";
        header("Location:/sign.php");
    }
} else {
    $_SESSION["success_message"] = "Заполните все поля";
    header("Location:/sign.php");
}


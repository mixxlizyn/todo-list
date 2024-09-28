<?php
require_once "connect.php";
session_start();
$id_user = $_SESSION["id"];

$title = isset($_POST["title"]) ? $_POST["title"] : false;
$descr = isset($_POST["descr"]) ? $_POST["descr"] : false;

if ($title and $descr) {
    // $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `task`(`id_user`, `title`, `descr`)
     VALUES ('$id_user','$title','$descr')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['success_message'] = 'Заметка создана!';
        header("Location: /");
    } else {
        $_SESSION["success_message"] = mysqli_error($con);
        header("Location: /");
    }
} else {
    $_SESSION["success_message"] = "Заоплните все поля!";
    header("Location: /");
}
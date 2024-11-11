<?php

require_once "connect.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id']; // ID текущего пользователя
    $task_id = $_POST['task_id']; // ID задачи
    $title = $_POST['title']; // Новый заголовок задачи
    $descr = $_POST['descr']; // Новое описание задачи


    // $is_completed = isset($_POST['checkbox']) ? 1 : 0;


    $sql = "UPDATE task SET title = ?, descr = ?, is_completed = ? WHERE id = ? AND id_user = ?";
}

if ($title && $descr && $user_id) {
    $sql = "UPDATE `task` SET `id_user`='$user_id',`title`='$title',`descr`='$descr' WHERE id='$task_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION["success_message"] = "Успех!";
    } else {
        $_SESSION["success_message"] = "Ошибка: " . mysqli_error($con);
    }
    header("Location: /");
} else {
    $_SESSION["success_message"] = "Ошибка!";
}

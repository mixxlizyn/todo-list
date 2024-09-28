<?php
session_start();
require_once "connect.php";


if (isset($_POST['task_id'])) {
    $taskId = $_POST['task_id'];
    $user_id = $_SESSION['id'];
    $isCompleted = $_POST['is_completed'] ? 1 : 0;

    $sql = "UPDATE `task` SET is_completed = $isCompleted WHERE id = $taskId AND id_user = $user_id";

    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Task ID not provided']);
}
?>
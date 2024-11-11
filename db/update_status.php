<?php
session_start();
require_once "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = intval($_POST['task_id']);
    $isCompleted = intval($_POST['is_completed']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $con->prepare("UPDATE task SET is_completed = ? WHERE id = ?");
    $stmt->bind_param("ii", $isCompleted, $taskId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'task_id' => $taskId, 'is_completed' => $isCompleted]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
}


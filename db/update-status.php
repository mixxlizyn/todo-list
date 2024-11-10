<?php
session_start();
require_once "connect.php";



$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['task_id']) && isset($data['completed'])) {
    $taskId = intval($data['task_id']);
    $completed = intval($data['completed']);

    // Обновление статуса заметки в базе данных
    $stmt = $pdo->prepare("UPDATE tasks SET is_completed	 = ? WHERE id = ?");
    $stmt->execute([$completed, $taskId]);

    // Возврат ответа
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
?>
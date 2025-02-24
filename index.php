<?php

session_start();
require_once "db/connect.php";
include "header1.php";

if (!isset($_SESSION['id'])) {
    header("Location: sign.php");
    exit();
}
$user_id = $_SESSION["id"];
$filter = isset($_POST['taskFilter']) ? $_POST['taskFilter'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter2 = isset($_POST['dateFilter']) ? $_POST['dateFilter'] : '';
$sql = "SELECT * FROM `task` WHERE 	id_user = $user_id";
if ($filter === '1') {
    $sql .= " AND is_completed = 1";
} elseif ($filter === '0') {
    $sql .= " AND is_completed = 0";
}

if (!empty($search)) {
    $sql .= " AND (title LIKE '%$search%' OR `descr` LIKE '%$search%')";
}

// Добавляем сортировку по дате
if ($filter2 === '1') {
    $sql .= " ORDER BY created_at DESC"; // Новые
} elseif ($filter2 === '0') {
    $sql .= " ORDER BY created_at ASC"; // Старые
}

$task = mysqli_query($con, $sql);

?>
<style>
    .note-title.completed {
        text-decoration: line-through;
        color: gray;
    }
</style>
<div class="container" style="margin-top: 70px;">
    <h1>СПИСОК ЗАМЕТОК</h1>
    <div class="search-bar">
        <div class="search-container">
            <form method="get" action="index.php" class="search-container">
                <input type="text" placeholder="поиск записи..." name="search" id="search">
                <button class="search-icon"><img src="img/lupa.png" alt="поиск"></button>
            </form>
        </div>
        <div class="filter">
            <div class="filter1">
                <form action="" method="post">
                    <select id="taskFilter" name="taskFilter" class="form-select" onchange="this.form.submit()">
                        <option value="" <?= $filter === '' ? "selected" : '' ?>>Все</option>
                        <option value="1" <?= $filter === '1' ? "selected" : '' ?>>Выполненные</option>
                        <option value="0" <?= $filter === '0' ? "selected" : '' ?>>Не выполненные</option>
                    </select>
                </form>
            </div>
            <div class="filter2">
                <form action="" method="post">
                    <select id="Filter" name="dateFilter" class="form-select" onchange="this.form.submit()">
                        <option value="" <?= $filter2 === '' ? "selected" : '' ?>>Все</option>
                        <option value="1" <?= $filter2 === '1' ? "selected" : '' ?>>Новые</option>
                        <option value="0" <?= $filter2 === '0' ? "selected" : '' ?>>Старые</option>
                    </select>
                </form>
            </div>
        </div>
        <button class="theme-toggle" id="select" onclick="darkLight()">
            <img src="img/lune.png" alt="темная тема" class="theme-dark" style="background: none;">
        </button>
    </div>

    <?php if (mysqli_num_rows($task) > 0): ?>
        <div class="center" style="display: flex; gap: 20px; justify-content: flex-start; flex-wrap: wrap;">
            <?php while ($tas = mysqli_fetch_assoc($task)):
                $isCompleted = $tas['is_completed'] == 1;
                $taskId = $tas['id'];
                ?>
                <div class="card text-center">
                    <form action="db/edit_db.php" method="POST">
                        <div class="task-item checkbox-content">
                            <input type="checkbox" id="checkbox-<?= $tas['id'] ?>"
                                onchange="updateStatus(this, <?= $tas['id'] ?>)" <?= $tas['is_completed'] ? 'checked' : '' ?>>
                            <label for="checkbox-<?= $tas['id'] ?>">Заметка №
                                <?= $tas['id'] ?>
                            </label>
                        </div>
                        <input type="hidden" name="task_id" value="<?= $taskId ?>">
                        <div class="card-header">
                            <input type="text" name="title" value="<?= $tas['title'] ?>" placeholder="Введите заголовок">
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <input type="text" name="descr" value="<?= $tas['descr'] ?>" placeholder="Введите описание">
                            </p>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                    <div class="card-footer text-body-secondary">
                        <a href="db/delete_db.php?id=<?= $taskId ?>" class="delete-btn" title="Удалить">&#x1F5D1;</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="img-empty" style="display: flex; justify-content: center;">
            <img class="center-img" src="img/empty.png" alt="пусто">
        </div>
    <?php endif; ?>

    <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Новая заметка</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="db\newtask_bd.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Название</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Описание</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="descr">
                    </div>

                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="dark.js"></script>
<!-- <script src="main.js"></script> -->
<script>

    function updateStatus(checkbox, taskId) {
        const isCompleted = checkbox.checked ? 1 : 0;

        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "db/update_status.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Send the request with task ID and completion status
        xhr.send("task_id=" + taskId + "&is_completed=" + isCompleted);

        // Optional: Handle the response
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("Status updated successfully: " + xhr.responseText);
            } else {
                console.error("Error updating status: " + xhr.status);
            }
        };
    }
</script>

</html>
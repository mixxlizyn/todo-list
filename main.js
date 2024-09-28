<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

function updateStatus(checkbox, taskId) {
    var isCompleted = checkbox.checked ? 1 : 0;

    $.ajax({
        url: 'db/update_task_status.php',
        type: 'POST',
        data: {
            task_id: taskId,
            is_completed: isCompleted
        },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.success) {
                console.log('Статус задачи успешно обновлен');
            } else {
                console.log('Ошибка при обновлении статуса задачи');
            }
        },
        error: function() {
            console.log('Ошибка при выполнении запроса');
        }
    });
}

  setTimeout(function () {
    var message = document.getElementById('message');
    if (message) {
        message.style.display = 'none'; 
    }
}, 500);





//тема менять
document.getElementById('themeToggle').addEventListener('click', function() {
    const currentTheme = document.body.className;
    if (currentTheme === 'light-theme') {
        document.body.className = 'dark-theme';
    } else {
        document.body.className = 'light-theme';
    }
}); 


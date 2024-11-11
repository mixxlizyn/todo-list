
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
function updateStatus(checkbox, taskId) {
    const status = checkbox.checked ? 1 : 0;
    console.log(`Updating task ID: ${taskId}, Status: ${status}`); // Debug log

    fetch('db/update-status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ task_id: taskId, completed: status }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Статус задачи успешно обновлен');
        } else {
            console.log('Ошибка при обновлении статуса задачи');
        }
    })
    .catch((error) => {
        console.error('Ошибка:', error);
    });
}

// function updateStatus(checkbox, taskId) {
//     var isCompleted = checkbox.checked ? 1 : 0;

//     $.ajax({
//         url: 'db/update_task_status.php',
//         type: 'POST',
//         data: {
//             task_id: taskId,
//             is_completed: isCompleted
//         },
//         success: function(response) {
//             try {
//                 const result = JSON.parse(response);
//                 if (result.success) {
//                     console.log('Статус задачи успешно обновлен');
//                 } else {
//                     console.log('Ошибка при обновлении статуса задачи');
//                 }
//             } catch (e) {
//                 console.log('Ошибка при парсинге ответа: ', e);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.log('Ошибка при выполнении запроса: ', error);
//         }
//     });
// }

// // Example of how to call updateStatus when a checkbox is clicked
// document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
//     checkbox.addEventListener('click', function() {
//         var taskId = this.getAttribute('data-task-id'); // Ensure your checkbox has this attribute
//         updateStatus(this, taskId);
//     });
// });

// setTimeout(function () {
//     var message = document.getElementById('message');
//     if (message) {
//         message.style.display = 'none'; 
//     }
// }, 500);
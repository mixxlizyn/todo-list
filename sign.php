<?php
session_start();
if (isset($_SESSION['success_message'])) {
    // Выводим сообщение, если оно есть
    echo "<div id='message' style='background-color: #175676; color: white; padding: 10px; text-align: center;'>
    {$_SESSION['success_message']}
</div>";

    // Очищаем сообщение из сессии после его отображения
    unset($_SESSION['success_message']);
}
?>
<style>
    /* Основные стили */
    body {
        flex-direction: column;
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .custom-form-wrapper {
        background-color: white;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 420px;
    }

    .custom-heading {
        color: #6c63ff;
        text-align: center;
        margin-bottom: 25px;
    }

    .custom-input-group {
        margin-bottom: 20px;
    }

    .custom-input-label {
        display: block;
        margin-bottom: 6px;
        color: #333;
    }

    .custom-input-field {
        width: 100%;
        padding: 12px;
        border-radius: 15px;
        border: 1px solid #ccc;
        outline: none;
        transition: border-color 0.3s;
    }

    .custom-input-field:focus {
        border-color: #6c63ff;
    }

    .custom-checkbox {
        width: auto;
        margin-right: 10px;
    }

    .custom-button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 15px;
        background-color: #6c63ff;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .custom-button:hover {
        background-color: #5a52e0;
    }

    .custom-error-message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
    }

    .custom-toggle-text {
        text-align: center;
        margin-top: 15px;
    }

    .custom-toggle-text a {
        color: #6c63ff;
        text-decoration: none;
    }

    .custom-toggle-text a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>

    <!-- Форма регистрации -->
    <div class="custom-form-wrapper" id="custom-register-container">
        <h2 class="custom-heading">Регистрация</h2>
        <form id="custom-registerForm" action="db\signup_db.php" method="post">

            <div class="custom-input-group">
                <label for="custom-register-login" class="custom-input-label">Логин</label>
                <input type="text" id="custom-register-login" name="login" class="custom-input-field"
                    placeholder="Введите ваш логин" required>
            </div>

            <div class="custom-input-group">
                <label for="custom-register-password" class="custom-input-label">Пароль</label>
                <input type="password" id="custom-register-password" name="pass" class="custom-input-field"
                    placeholder="Введите пароль" required minlength="6">
            </div>


            <div class="custom-error-message" id="custom-register-error"></div>
            <button type="submit" class="custom-button">Зарегистрироваться</button>
        </form>
        <div class="custom-toggle-text">
            <p>Уже зарегистрированы? <a href="#" onclick="toggleCustomForms()">Войти</a></p>
        </div>
    </div>

    <!-- Форма авторизации -->
    <div class="custom-form-wrapper" id="custom-login-container" style="display: none;">
        <h2 class="custom-heading">Авторизация</h2>
        <form id="custom-loginForm" action="db\signin_db.php" method="post">
            <div class="custom-input-group">
                <label for="custom-login-login" class="custom-input-label">Логин</label>
                <input type="text" id="custom-login-login" name="login" class="custom-input-field"
                    placeholder="Введите ваш логин" required>
            </div>
            <div class="custom-input-group">
                <label for="custom-login-password" class="custom-input-label">Пароль</label>
                <input type="password" id="custom-login-password" name="pass" class="custom-input-field"
                    placeholder="Введите пароль" required>
            </div>
            <div class="custom-error-message" id="custom-login-error"></div>
            <button type="submit" class="custom-button">Войти</button>
        </form>
        <div class="custom-toggle-text">
            <p>Еще нет аккаунта? <a href="#" onclick="toggleCustomForms()">Зарегистрироваться</a></p>
        </div>
    </div>

    <script>
        // Функция переключения между формамикп
        function toggleCustomForms() {
            var registerForm = document.getElementById('custom-register-container');
            var loginForm = document.getElementById('custom-login-container');

            if (registerForm.style.display === 'none') {
                registerForm.style.display = 'block';
                loginForm.style.display = 'none';
            } else {
                registerForm.style.display = 'none';
                loginForm.style.display = 'block';
            }
        }
    </script>

</body>

</html>
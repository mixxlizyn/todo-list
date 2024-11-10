
// Проверяем состояние темы при загрузке страницы
document.addEventListener("DOMContentLoaded", () => {
    // Проверяем, сохранено ли состояние темы в localStorage
    if (localStorage.getItem("darkTheme") === "enabled") {
        enableDarkTheme();
        dark = true; // Устанавливаем значение dark в true, если тема темная
    } else {
        disableDarkTheme();
        dark = false; // Устанавливаем значение dark в false, если тема светлая
    }
});

// Функция включения темной темы
function enableDarkTheme() {
    document.querySelectorAll('*').forEach(element => element.classList.add("theme-dark"));
    localStorage.setItem("darkTheme", "enabled");
}

// Функция выключения темной темы
function disableDarkTheme() {
    // Удаляем класс "theme-dark" у всех элементов на странице
    document.querySelectorAll('*').forEach(element => element.classList.remove("theme-dark"));
    // Сохраняем состояние темы в localStorage
    localStorage.setItem("darkTheme", "disabled");
}

// Функция переключения темы при нажатии на кнопку
function darkLight() {
    if (!dark) {
        enableDarkTheme(); // Включаем темную тему
    } else {
        disableDarkTheme(); // Отключаем темную тему
    }
    // Меняем значение флага dark на противоположное
    dark = !dark;
}

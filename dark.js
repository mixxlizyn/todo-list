// на старте тёмная тема не установлена
var dark = false;
// получаем доступ ко всей странице и к абзацу с переключателем
var a = document.body;
// var p = document.getElementById("select")

// эта функция будет срабатывать при нажатии на переключатель
function darkLight() {
	// если тёмная тема не активна
	if (!dark) {
		// добавляем класс с тёмной темой ко всей странице
		a.className = "theme-dark";
		// меняем надпись на переключателе

	// а если активна — 
	} else {
		// добавляем класс со светлой темой ко всей странице
		a.className = "theme-light";
		// меняем надпись на переключателе
		
	}

	// меняем значение темы на противоположное
	dark = !dark;
	
}
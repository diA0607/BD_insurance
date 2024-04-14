<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
	<link rel="stylesheet" href="../Style/styles.css"> <!-- Ссылка на файл CSS -->

</head>
<body>
<nav>
    <div>
        <a class="a_nav" href="../index.php">Главная страница</a>
                <?php
                if ($_COOKIE['user'] == ''):
                    ?>
                    <a class="a_nav" href="auth.php">Вход в личный кабинет</a>
                <?php else: ?>
                    <a class="a_nav" href="registration.php">Личный кабинет</a>
                <?php endif;?>
                <a class="a_nav" href="Сontacts.php">Контактная информация</a>
                <!--<a class="a_nav" href="News.php">Лента новостей</a> -->
                <a class="a_nav" href="Products.php">Наши филиалы</a>
				<a class="a_nav" href="gallery.php">Галерея</a>
    </div>
</nav>

<div class="content">
    <div class="auth">
        <h1>Авторизация</h1>
        <form method="POST">
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" placeholder="Введите логин" required><br>
            <label for="pass">Пароль:</label>
            <input type="password" id="pass" name="pass" placeholder="Введите пароль" required><br>
			<input type="checkbox" id="robot" name="robot">
				<label for="robot">I'm not a robot</label><br><br>
                
			<p>Еще нет аккаунта? <a href="registration.php">Зарегистрируйтесь здесь</a>.</p>
		<button type="submit">Авторизоваться</button>
        </form>
        
    </div>
</div>

	<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, была ли установлена галочка "I'm not a robot"
    if (!isset($_POST['robot'])) {
        // Если галочка не отмечена, перенаправляем обратно на форму с сообщением об ошибке
        header("Location: auth.php?error=robot_not_checked");
        exit();
    }

    // Подключаемся к базе данных
    $mysql = mysqli_connect("localhost", "root", "", "new3333");
    if (!$mysql) {
        die("Error connect to database!");
    }

    // Получаем логин и пароль из формы
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

    // Выполняем запрос к базе данных для проверки логина и пароля
    $result = mysqli_query($mysql, "SELECT * FROM `клиенты` WHERE `клиенты`.`Логин_клиента` = '$login' AND `клиенты`.`Пароль_клиента` = '$pass'");
    $user = mysqli_fetch_assoc($result);

    // Проверяем, найден ли пользователь в базе данных
    if (!$user) {
        // Если пользователь не найден, перенаправляем обратно на форму с сообщением об ошибке
        header("Location: auth.php?error=invalid_credentials");
        exit();
    }

    // Устанавливаем cookie для пользователя и перенаправляем на другую страницу
    setcookie('user', $user['Логин_клиента'], time() + 3600, "/");
    setcookie('fio_user', $user['ФИО'], time() + 3600, "/");
    $mysql->close();

    header("Location: registration.php");
    exit();
}
?>

</html>


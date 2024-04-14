<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Страховое агентство</title>
	<link rel="stylesheet" href="../Style/styles.css"> <!-- Ссылка на файл CSS -->
</head>
<body>
<nav>
    <div>
       <a class="a_nav" href="../index.php">Главная страница</a>
                <?php
                if ($_COOKIE['user'] == ''):
                    ?>
                    <a class="a_nav" href="../main_page/auth.php">Вход в личный кабинет</a>
                <?php else: ?>
                    <a class="a_nav" href="../main_page/registration.php">Личный кабинет</a>
                <?php endif;?>
                <a class="a_nav" href="../main_page/Сontacts.php">Контактная информация</a>
                <!--<a class="a_nav" href="News.php">Лента новостей</a> -->
                <a class="a_nav" href="../main_page/Products.php">Наши филиалы</a>
				<a class="a_nav" href="../main_page/gallery.php">Галерея</a>
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
			<p>Еще нет аккаунта? <a href="../main_page/registration.php">Зарегистрируйтесь здесь</a>.</p>
		<button type="submit">Авторизоваться</button>
        </form>
        
    </div>
</div>

	<?php

$mysql = mysqli_connect("localhost", "root", "", "new3333");
if (!$mysql)
    die("Error connect to database!");
	if (isset($_POST['out'])) {
    setcookie('user', $_COOKIE['Логин_клиента'], time() - 3600, "/");
	setcookie('fio_user',  $_COOKIE['ФИО'], time() - 3600, "/");
	
	exit();
}
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);

    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

    //$pass = md5($pass."qwer2345");

    $result = mysqli_query($mysql, "SELECT * FROM `клиенты` WHERE `клиенты`.`Логин_клиента` = '$login' AND `клиенты`.`Пароль_клиента` ='$pass'");

    $user = mysqli_fetch_assoc($result);
    if(count($user)==0){
     
        exit();
    }
    setcookie('user', $user['Логин_клиента'], time() + 3600, "/");
    setcookie('fio_user', $user['ФИО'], time() + 3600, "/");
    $mysql->close();

    header("Location: ../main_page/zakaz.php");
    exit();
?>
</body>
</html>


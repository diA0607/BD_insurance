<?php
session_start();

$mysql = mysqli_connect("localhost", "root", "", "new");
if (!$mysql)die("Error connect to database!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
	<link rel="stylesheet" href="styles.css"> <!-- Ссылка на файл CSS -->
    <style>
        BODY {
            background: url(background2.jpg) no-repeat 0px 0px; /* Параметры фона */
            background-size: 100%;
        }
        nav{
            display: block;
            padding-top: 10px; /* Поля */
            padding-bottom: 10px; /* Поля */
            background: #A65546; /* Цвет фона */
            margin-left: -10px;
            margin-right: -10px;
            margin-top: 30px;
            text-align: center;
            opacity: 90%;   /* Прозрачность */
        }
        .a_nav{
            margin: 7px;
            color: #cba8a6;
            text-decoration: none
        }
        .content{
            margin-top: 30px;
            margin-left: 25%;
            width: 50%;
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .auth{
            padding: 0 20px 20px 20px;
            background: #A65546; /* Цвет фона */
            opacity: 90%;   /* Прозрачность */
            border-radius: 20px;
            text-align: center;
            color: #cba8a6;
        }
        .prof{
            width: 20%;
            background: #A65546; /* Цвет фона */
            opacity: 90%;   /* Прозрачность */
            border-radius: 20px;
            text-align: center;
            color: #cba8a6;
        }
    </style>
</head>
<body>

<nav>
    <div>
        <a class="a_nav" href="index.php">Домашняя страница</a>
        <?php
        if ($_COOKIE['login_admin'] == ''):
            ?>
            <a class="a_nav" href="Registration.php">Вход в личный кабинет</a>
        <?php else: ?>
            <a class="a_nav" href="Registration.php">Личный кабинет</a>
        <?php endif;?>
        <a class="a_nav" href="Сontacts.php">Контакты</a>
        <a class="a_nav" href="News.php">Новости</a>
        <a class="a_nav" href="Products.php">Наши филиалы</a>
        <?php
        if ($_COOKIE['login_admin'] == ''):
            ?>
        <?php else: ?>
            <a class="a_nav" href="Order.php">Заказ</a>
        <?php endif;?>

    </div>
</nav>

<?php
if ($_COOKIE['login_admin'] == ''):
    ?>
    <div class="content">
        <div class="auth">
            <h1>Авторизация</h1>
            <form method="POST" action="auth_admin.php">
                <label for="login">Логин:</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин" required><br><br>

                <label for="pass">Пароль:</label>
                <input type="password" id="pass" name="pass" placeholder="Введите пароль" required><br><br>
                <?php

                $error = $_GET['error'];

                if ($error === 'empty_id') {
                    echo "Неправильные данные";
                    echo "<br>";
                }
                ?>
                <button type="submit">Авторизоваться</button>
            </form>
        </div>
    </div>
<?php else: ?>
    <div align="center">
        <div class="prof">
            <p> Привет Админ, рады тебя видеть!</p>
            <P> Login: <?=$_COOKIE['login_admin']?></P>
            <P> Name: <?=$_COOKIE['fio_admin']?></P>

           <form method="POST" action="auth_admin.php">
					<button type="submit" name="out">Выйти</button>
				</form>
        </div></div>

<?php endif;?>

</body>
</html>

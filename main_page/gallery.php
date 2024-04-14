<?php
$mysql = mysqli_connect("localhost", "root", "", "new3333");
if (!$mysql)
    die("Error connect to database!");

$res2 = mysqli_query($mysql, "SELECT * FROM `галерея`");
$stocks = mysqli_fetch_all($res2, MYSQLI_ASSOC);
?>

<html>
<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	<h2 style="border-bottom: solid 5px #4682B4; text-decoration-color: #4682B4; text-align: center;">Галерея</h2>

			<div align = "center">
			<?php $GAL = mysqli_query($mysql, "SELECT * FROM галерея"); 
			while($outgal = mysqli_fetch_array($GAL))
			{
				echo '<img src="'.$outgal[1]. '" width="240" height="160">	';
			}
			?>
			</div>

</body>
</html>
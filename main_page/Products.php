<?php
$mysql = mysqli_connect("127.0.0.1", "root", "", "new3333");
if(!$mysql)
    die("Error connect to database!");
?>

<!DOCTYPE html>
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
	<p></p>
		<h2 style="border-bottom: solid 5px #4682B4; text-decoration-color: #4682B4; text-align: center;" >Адреса филиалов</h2>
	<p></p>


<?php

    // Формируем основной запрос
    $multiQuery = "SELECT филиалы.Название, филиалы.Адрес,филиалы.Часы_работы, филиалы.Номер_телефона
                    FROM филиалы ";
  
    // Выполняем запрос
    $result = mysqli_query($mysql, $multiQuery);
    if ($result) {
        // Отображаем результат запроса в виде таблицы
        echo "<table border='1'>";
        echo "<tr><th>Название</th><th>Адрес</th><th>Часы работы</th><th>Контактный номер</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Название'] . "</td>";
            echo "<td>" . $row['Адрес'] . "</td>";
			echo "<td>" . $row['Часы_работы'] . "</td>";
            echo "<td>" . $row['Номер_телефона'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Error executing multi-table query: " . mysqli_error($mysql);
    }
?>

</body>
</html>
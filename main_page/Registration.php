<?php
session_start();

$mysql = mysqli_connect("localhost", "root", "", "new3333");
if (!$mysql)die("Error connect to database!");
?>
<?php
    if (isset($_POST["out"])) {
        // Сбросьте или удалите cookie
        setcookie('user', '', time() - 3600, "/");
        setcookie('fio_user', '', time() - 3600, "/");
        // Перенаправьте на index.php
        header("Location: ../index.php");
        exit();
    } 
?>

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

    <?php
        if ($_COOKIE['user'] == ''):
    ?>
    <div class="content">
        <div class="reg">
            <h1>Регистрация</h1>
            <form method="POST" action="../Registration/check.php">
				<label for="fio">ФИО:</label>
                <input type="text" class="form-control" id="fio" name="fio" placeholder="Введите ФИО" required><br><br>
				<label for="pasp">Паспортные данные:</label>
                <input type="text" class="form-control" id="pasp" name="pasp" placeholder="Введите паспортные данные" required><br><br>
                <label for="addr">Адрес проживания:</label>
                <input type="text" class="form-control" id="addr" name="addr" placeholder="Введите адрес проживания" required><br><br>
                <label for="phone">Номер телефона:</label>
                <input type="text" id="phone" name="phone" 
				placeholder="Введите номер телефона" required><br><br>
                <label for="login">Логин:</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин" required><br><br>
                <label for="pass">Пароль:</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Введите пароль" required><br><br>
				 <p>У вас уже есть аккаунт? <a href="auth.php">Авторизироваться</a>.</p>
                <?php
                $error = $_GET['error'];
                if ($error === 'size_log') {
                    echo "Недопустимая длина логина";
                    echo "<br>";
                }
                ?>
                <?php
                $error = $_GET['error'];
                if ($error === 'size_name') {
                    echo "Недопустимая длина имени";
                    echo "<br>";
                }
                ?>
				
                <button type="submit">Зарегистрироваться</button>
				
            </form>
        </div>
        
    </div>
    <?php else: ?>
        <div align="center">
         <div class="prof">
                <p> Привет, рады тебя видеть!</p>
                <P> Логин: <?=$_COOKIE['user']?></P>
                <P> ФИО: <?=$_COOKIE['fio_user']?></P>
				<form method="POST">
					<button type="submit" name="out">Выйти</button>
				</form>
         </div></div>
            <div class="orders" align="center">
				<h2>Ваши договора:</h2>
				<?php
				$login = $_COOKIE['user'];
				$id_client_result = mysqli_query($mysql, "SELECT `Код_клиента` FROM `клиенты` WHERE `клиенты`.`Логин_клиента` = '$login'");
				$id_client_row = mysqli_fetch_assoc($id_client_result);
				$id_client = $id_client_row['Код_клиента'];

				$query = "SELECT `договора`.`Код_договора`, 
								  `договора`.`Сумма_страхования`, 
								  `договора`.`Скидка`, 
								  `договора`.`Дата_страхования`, 
								  `договора`.`Срок_страхования(в месяцах)`,
								  `предмет_страхования`.`Наименование`,
								  `сотрудники`.`ФИО`
						  FROM `договора`
						  JOIN `клиенты` ON `договора`.`Код_клиента` = `клиенты`.`Код_клиента`
						  JOIN `предмет_страхования` ON `договора`.`Код_предмета_страхования` = `предмет_страхования`.`Код_предмета_страхования`
						  JOIN `сотрудники` ON `договора`.`Код_сотрудника` = `сотрудники`.`Код_сотрудника`
						  WHERE `клиенты`.`Логин_клиента` = '$login'";
				$result = mysqli_query($mysql, $query);

				if (!$result) {
					die('Ошибка MySQL: ' . mysqli_error($mysql));
				}
				?>
				<table border="1" cellpadding="5">
					<tr>
						<th>Код договора</th>
						<th>Предмет страхования</th>
						<th>Сумма страхования</th>
						<th>Скидка</th>
						<th>Дата страхования</th>
						<th>Срок страхования (в месяцах)</th>
						<th>ФИО сотрудника</th>
					</tr>
					<?php
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['Код_договора'] . "</td>";
						echo "<td>" . $row['Наименование'] . "</td>";
						echo "<td>" . $row['Сумма_страхования'] . "</td>";
						echo "<td>" . $row['Скидка'] . "</td>";
						echo "<td>" . $row['Дата_страхования'] . "</td>";
						echo "<td>" . $row['Срок_страхования(в месяцах)'] . "</td>";
						echo "<td>" . $row['ФИО'] . "</td>";
						echo "</tr>";
					}
					?>
				</table>
            </div>
			<div class="orders" align="center">
    <h2>Корзина:</h2>
	
    <?php
    $login = $_COOKIE['user'];
    $id_client_result = mysqli_query($mysql, "SELECT `Код_клиента` FROM `клиенты` WHERE `клиенты`.`Логин_клиента` = '$login'");
    $id_client_row = mysqli_fetch_assoc($id_client_result);
    $id_client = $id_client_row['Код_клиента'];

    $query = "SELECT `корзина`.`Код_предмета_страхования`, 
                      `корзина`.`Сумма_страхования`, 
                      `корзина`.`Дата_создания`, 
                      `корзина`.`Срок_страхования`,
                      `предмет_страхования`.`Наименование`,
					  `корзина`.`Код_заказа`
              FROM `корзина`
              JOIN `предмет_страхования` ON `корзина`.`Код_предмета_страхования` = `предмет_страхования`.`Код_предмета_страхования`
			  WHERE `корзина`.`Код_клиента` = '$id_client'";
    $result = mysqli_query($mysql, $query);

    if (!$result) {
        die('Ошибка MySQL: ' . mysqli_error($mysql));
    }
    ?>
	
    <table border="1" cellpadding="5">
        <tr>
            <th>Предмет страхования</th>
            <th>Сумма страхования</th>
            <th>Дата создания</th>
            <th>Срок страхования</th>
            <th>Действия</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['Наименование']; ?></td>
                <td><?php echo $row['Сумма_страхования']; ?></td>
                <td><?php echo $row['Дата_создания']; ?></td>
                <td><?php echo $row['Срок_страхования']; ?></td>
                <form method="POST">
                    <td>
                        <a class="order-button"  href="../Order/delete.php?id=<?= $row['Код_заказа'] ?>">Удалить</a>
                    </td>
                </form>
            </tr>
			
            <?php
        }
        ?>
    </table>
	<p></p>
	<div style="text-align: right;">
    <a class="order-button" href="zakaz.php?>">Оформить заказ</a>
	</div>
</div>

    <?php endif;?>

</body>
</html>

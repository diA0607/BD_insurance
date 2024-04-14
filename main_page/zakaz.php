<?php
session_start();

$mysql = mysqli_connect("localhost", "root", "", "new3333");
if (!$mysql) die("Error connect to database!");

// Проверка авторизации
if (!isset($_COOKIE['user'])) {
    header("Location: ../Order/zakaz_auth.php");
    exit();
}

$login = $_COOKIE['user'];
$id_client_result = mysqli_query($mysql, "SELECT `Код_клиента` FROM `клиенты` WHERE `клиенты`.`Логин_клиента` = '$login'");
$id_client_row = mysqli_fetch_assoc($id_client_result);
$id_client = $id_client_row['Код_клиента'];
$query = "SELECT * FROM `предмет_страхования`";
$result_products = mysqli_query($mysql, $query);

$res = mysqli_query($mysql, "SELECT предмет_страхования.Наименование, предмет_страхования.Минимальная_сумма_страхования, предмет_страхования.Максимальная_сумма_страхования 
                FROM предмет_страхования");
$mysql->close();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="../Style/styles.css"> <!-- Ссылка на файл CSS -->
    <title>Страховое агентство</title>
    
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
    <h3 align="center">Виды страхования с максимальной и минимальной стоимостями</h3>
	<div class="orders1" align="center">
<?php

if ($res) {
    // Отображаем результат запроса в виде таблицы
    echo "<table border='1'>";
    echo "<tr><th>Наименование</th><th>Минимальная сумма страхования</th><th>Максимальная сумма страхования</th></tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>" . $row['Наименование'] . "</td>";
        echo "<td>" . $row['Минимальная_сумма_страхования'] . "</td>";
        echo "<td>" . $row['Максимальная_сумма_страхования'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error executing multi-table query: " . mysqli_error($mysql);
}
?>
</div>
<?php if ($_COOKIE['user']): ?>
<p></p>
    <h3 align="center">Оформление заказа страхования</h3>
	<div class="orders1" align="center">
    <form method="POST" action="../Order/zakaz_insert.php">
        <table border="1" align="center" class="t">
            <tr>
                <th>Предмет страхования</th>
                <th>Сумма страхования</th>
                <th>Дата создания</th>
                <th>Срок страхования (в месяцах)</th>
                <th>Код клиента</th>
            </tr>
            <tr>
                <td>
                    <select name="product_id[]">
						<?php if(isset($_GET['id'])): ?>
						<?php while ($product = mysqli_fetch_assoc($result_products)): ?>
							<?php if($product['Код_предмета_страхования'] == $_GET['id']): ?>
								<option value="<?php echo $product['Код_предмета_страхования']; ?>" selected><?php echo $product['Наименование']; ?></option>
							<?php else: ?>
								<option value="<?php echo $product['Код_предмета_страхования']; ?>"><?php echo $product['Наименование']; ?></option>
							<?php endif; ?>
						<?php endwhile; ?>
					<?php else: ?>
						<?php while ($product = mysqli_fetch_assoc($result_products)): ?>
							<option value="<?php echo $product['Код_предмета_страхования']; ?>"><?php echo $product['Наименование']; ?></option>
						<?php endwhile; ?>
					<?php endif; ?>
					</select>

                </td>
                <td><input type="int" name="insurance_amount[]"></td>
                <td><input type="text" name="start_date[]" value="<?php echo date('d-m-Y'); ?>"></td>
                <td><input type="int" name="insurance_term[]"></td>
                <td><input type="int" name="id_client[]" value="<?php echo $id_client; ?>" readonly></td>
            </tr>
        </table>
		<p></p>
		<p>*Уважаемый клиент!<br>Ваша оформленная корзина находится в личном кабинете</p>
		<button class="order-button" type="submit">Оформить заказ</button>
		<button class="order-button" type="button" id = "addRowButton">Добавить еще</button>
		<button class="order-button" type="submit">Выход</button>
    </form>
	</div>
	
<script>
 document.addEventListener("DOMContentLoaded", function() {
            var addRowButton = document.getElementById("addRowButton");
            addRowButton.addEventListener("click", function() {
                var table = document.querySelector(".t");
                var lastRow = table.rows[table.rows.length - 1].cloneNode(true);
                var inputs = lastRow.querySelectorAll('input[type="text"], input[type="int"]');
                // Очистка значений ввода для новой строки
                inputs.forEach(function(input) {
                    input.value = "";
                });
				
                // Автоматическое заполнение поля "Дата начала"
                var startDateInput = lastRow.querySelector('input[name="start_date[]"]');
                startDateInput.value = "<?php echo date('d-m-Y'); ?>";
                // Автоматическое заполнение поля "Код клиента"
                var idClientInput = lastRow.querySelector('input[name="id_client[]"]');
                idClientInput.value = "<?php echo $id_client; ?>";
                table.appendChild(lastRow);
            });
        });
</script>
<?php else: ?>
    <p>Для оформления заказа страхования необходимо авторизоваться.</p>
    <a href="../Order/zakaz_auth.php">Войти в личный кабинет</a>
<?php endif; ?>
</body>
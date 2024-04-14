<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
$mysql = mysqli_connect("127.0.0.1", "root","","new3333");
if(!$mysql)
 die("Error connect to database!");
mysqli_query( $mysql , "DELETE FROM `корзина` WHERE `корзина`.`Код_заказа` = $id" );
}
else {
    echo "Ошибка: Не передан параметр id.";
}
header("Location: ../main_page/registration.php?forms=ID");
?>
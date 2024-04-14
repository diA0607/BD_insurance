<?php
session_start();

$mysql = mysqli_connect("localhost", "root", "", "new");
if (!$mysql)
    die("Error connect to database!");
if (isset($_POST['out'])) {
    setcookie('login_admin', $_COOKIE['Логин_сотрудника'], time() - 3600, "/");
	setcookie('fio_admin',  $_COOKIE['ФИО'], time() - 3600, "/");
	header("Location: /Admin.php");
	exit();
}
$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);

$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
print_r($_POST['login']."<br>");
print_r($login."<br>");
print_r($_POST['pass']."<br>");
print_r($pass."<br>");

$result = mysqli_query($mysql, "SELECT * FROM `сотрудники` WHERE `сотрудники`.`Логин_сотрудника` = '$login' AND `сотрудники`.`Пароль_сотрудника` ='$pass'");

$user = mysqli_fetch_assoc($result);
if(count($user)==0){
    header("Location: /Admin.php?error=empty_id");
    exit();
}
setcookie('login_admin', $user['Логин_сотрудника'], time() + 3600, "/");
setcookie('fio_admin', $user['ФИО'], time() + 3600, "/");


$mysql->close();

header("Location: /Admin.php");
exit();

?>
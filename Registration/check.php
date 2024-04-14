<?php
if (!isset($_POST['robot'])) {
    // Если галочка не отмечена, перенаправляем обратно на форму с сообщением об ошибке
    header("Location: ../main_page/registration.php?error=robot_not_checked");
    exit();
}

$mysql = mysqli_connect("127.0.0.1", "root", "", "new3333");
echo "Сейчас я изучаю PHP!<br>";
if (!$mysql)
    die("Error connect to database!");
    
    $fio = filter_var(trim($_POST['fio']),FILTER_SANITIZE_STRING);
	$pasp = filter_var(trim($_POST['pasp']),FILTER_SANITIZE_STRING);
	$addr = filter_var(trim($_POST['addr']),FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST['phone']),FILTER_SANITIZE_STRING);
	$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING); 


    if (mb_strlen($login) < 1 || mb_strlen($login) > 90){

        header("Location: ../main_page/registration.php?error=size_log");
        exit();
    }else if (mb_strlen($pass) < 2 || mb_strlen($pass) > 6) {

        header("Location: ../main_page/registration.php?error=size_pass");
        exit();
    }

    //$pass = md5($pass."qwer2345");

    $mysql->query("INSERT INTO `клиенты` (ФИО, Паспортные_данные, Адрес_проживания, Номер_телефона, Логин_клиента, Пароль_клиента) VALUES ('$fio','$pasp','$addr','$phone', '$login','$pass')");
	  
    $mysql->close();
    header("Location: ../main_page/auth.php");
    exit();

?>
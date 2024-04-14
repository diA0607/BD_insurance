<?php
// C:\OpenServer\userdata\temp\email
    $err = "";
    $msg = "";
    if($_POST) {

        $name = "";
        $email = "";
        $message = "";
        $recipient = "dianochka.alieva.02@mail.ru";

        if(isset($_POST['fName']))
            $name = filter_var($_POST['fName'], FILTER_SANITIZE_STRING);
        if(isset($_POST['fEmail'])) {
            $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['fEmail']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        }
        if(isset($_POST['fMessage'])) {
            $message = htmlspecialchars($_POST['fMessage']);
            $message = str_replace("\n.", "\n..", $message);
            $message = wordwrap($message, 70, "\r\n");
        }


        $headers  = 'MIME-Version: 1.0' . "\r\n"
            .'Content-type: text/html; charset=utf-8' . "\r\n"
            .'From: ' . $email . "\r\n";

        if(mail($recipient, "Contact", $message, $headers)) {
            $msg = "Спасибо, что связались с нами, $name";
        } else {
            $err = 'Сожалеем, но письмо не дошло';
        }

    } else
        $err = 'Что-то пошло не так';

    setcookie('msg', $msg, time() + 30, "/");
    setcookie('err', $err, time() + 30, "/");
    header("Location: ../main_page/Сontacts.php");
?>

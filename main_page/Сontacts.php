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
    <div align="center">
    <div class="inf" >
        <h1>Контакты</h1>
        <p> Адрес главного офиса: г. Санкт-Петербург ул.Лиговский проспект д.6.</p>
		<p> Часы работы: 9.00 - 18.00.</p>
        <p> Если у вас появились вопросы, вы можете отправить их на почту <a href="mailto:yourinsuranceagency@mail.ru">yourinsuranceagency@mail.ru</a></p>
        <p> и позвонить по телефону <strong>+79114421000.</strong></p>
        <p> Также вы можете заполнить форму ниже, мы обязательно свяжемся с вами в рабочее время</p>
        <td class="cont_form">
            <div style="display: table-cell">
                <form action="contact.php" method="POST">

                    <div class="input-container">
						<label for="fName1" class="placeholder">Имя*</label><br>
                        <input class="input" placeholder=" " type="text" name="fName" id="fName1" required>
                        
                    </div>
                    <div class="input-container">
					<label for="fEmail1" class="placeholder">Email*</label><br>
                        <input class="input" placeholder=" " type="email" name="fEmail" id="fEmail1" required>
                        
                    </div>
                    <div class="input-container">
						<label for="fMessage1" class="placeholder">Сообщение*</label><br>
                        <textarea class="input" placeholder=" " name="fMessage" id="fMessage1" cols="40" rows="6" required></textarea>
                    </div>
					<p>Поля, отмеченные звездочкой (*), обязательны для заполнения. Нажимая кнопку "Отправить", вы даете согласие на обработку персональных данных и соглашаетесь с политикой конфиденциальности.</p>
                    <div class="form_radio_btn" style="margin: 0 auto;">
                        <input type="submit" id="fSubmit1">
                        <label for="fSubmit1"></label>
                        <input type="reset" id="fReset1">
                        <label for="fReset1"></label>
                    </div>
                </form>
            </div>
        </td>
    </div></div>


</body>
</html>
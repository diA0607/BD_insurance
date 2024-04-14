<?php
$mysql = mysqli_connect("127.0.0.1", "root", "", "new3333");
if(!$mysql)
    die("Error connect to database!");
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
                <a class="a_nav" href="Admin/Admin.php">Кабинет агента</a>
                <a class="a_nav" href="index.php">Главная страница</a>
                <?php
                if ($_COOKIE['user'] == ''):
                    ?>
                    <a class="a_nav" href="main_page/auth.php">Вход в личный кабинет</a>
                <?php else: ?>
                    <a class="a_nav" href="main_page/registration.php">Личный кабинет</a>
                <?php endif;?>
                <a class="a_nav" href="main_page/Сontacts.php">Контактная информация</a>
                <!--<a class="a_nav" href="News.php">Лента новостей</a> -->
                <a class="a_nav" href="main_page/Products.php">Наши филиалы</a>
				<a class="a_nav" href="main_page/gallery.php">Галерея</a>
				
                
            </div>

    </nav>
    <div class="content">
	
    
	
<div class="image_with_text">
    <img class="foto_main" src="/images/main1.jpg" alt="Картинка">
    <div class="text_right">
        <h3>&nbsp;&nbsp; &nbsp;Добро пожаловать в "Ваше страховое агентство"!<br>
Мы рады приветствовать вас на нашем сайте. Наша миссия - обеспечить вас надежной защитой, когда речь заходит о ваших самых ценных активах и сферах жизни.<br>
&nbsp; &nbsp; &nbsp; В "Ваше страховое агентство" мы стремимся предоставить нашим клиентам не только качественные страховые продукты, но и персонализированный подход, который отвечает их уникальным потребностям и обеспечивает их спокойствие в самых различных ситуациях. Мы здесь, чтобы помочь вам найти оптимальные решения для защиты ваших интересов и обеспечения финансового комфорта.<br>&nbsp; &nbsp; &nbsp; С уважением,<br>&nbsp; &nbsp; &nbsp; Команда "Ваше страховое агентство"</h3>
    </div>
</div>

    </div>
	
    <div class="prod1">
        <div class="prod1__header"><h3 style="text-align: center">Виды страхования</h3></div>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=1">
                    <div>-Наземный транспорт</div>
                    <img class="foto"; src="/images/avto-round.png" alt="Автострахование">
                </div>
				</td>
				
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=2">
                    <div>-Земельный участок</div>
                    <img class="foto"; src="/images/uchastok-round.png" alt="Страхование квартиры/дома">
					</div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=3">
                    <div>-Страхование недвижимости</div>
                    <img class="foto"; src="/images/home-round.png" alt="Страхование квартиры/дома">
					</div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=4">
                    <div>-Водный странспорт</div>
                    <img class="foto"; src="/images/water-round.png" alt="Страхование квартиры/дома">
					</div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=7">
                    <div>-Воздушный транспорт</div>
                    <img class="foto"; src="/images/fly-round.png" alt="Автострахование">
					</div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=6">
                    <div>-Сельхозтехника</div>
                    <img class="foto"; src="/images/traktor-round.png" alt="Страхование квартиры/дома">
					</div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=5">
                    <div>-Строения</div>
                    <img class="foto"; src="images/stroeniye-round.png" alt="Страхование квартиры/дома">
					</div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
				<div class="prod1_content">
				<a href="main_page/zakaz.php?id=8">
                    <div>-Медицинское</div>
                    <img class="foto"; src="/images/health-round.png" alt="Страхование квартиры/дома">
					</div>
                </td>
            </tr>
        </table>
    </div>
	 <h3 align="center">Акции и предложения месяца</h3>
	 <?php include 'news.php'; ?>
	
</body>
</html>
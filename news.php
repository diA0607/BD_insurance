<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Страховое агентство</title>
    <style>
        .page {
            width: 100%;
            text-align: center;
        }
        .stock {
            display: none;
        }
        .stock.active {
            display: block;
        }
    </style>
</head>
<body>
<div class="page">
    <div class="content_news">
        <div align="center" class="stocks">
            <?php
            $res = mysqli_query($mysql, "SELECT * FROM `акции`");
            $firstStock = true;
            while ($stock = mysqli_fetch_assoc($res)) {
            ?>
                <div class="stock <?= $firstStock ? 'active' : '' ?>">
                    <h2 align="center"><?= $stock['Заголовок'] ?></h2>
                    <p><?= $stock['Описание'] ?></p>
                </div>
            <?php
                $firstStock = false;
            }
            ?>
        </div>
    </div>
</div>
<div align="center">
<button class="order-button" onclick="prevStock()">Назад</button>
	<button class="order-button" onclick="nextStock()">Вперед</button>
	
</div>

<script>
    var stocks = document.querySelectorAll('.stock');
    var currentStockIndex = 0;

    function showStock(index) {
        // Скрыть все акции
        stocks.forEach(function(stock) {
            stock.classList.remove('active');
        });
        // Показать акцию с указанным индексом
        stocks[index].classList.add('active');
    }

    function nextStock() {
        currentStockIndex = (currentStockIndex + 1) % stocks.length;
        showStock(currentStockIndex);
    }

    function prevStock() {
        currentStockIndex = (currentStockIndex - 1 + stocks.length) % stocks.length;
        showStock(currentStockIndex);
    }

    // Автоматическое перелистывание каждые 5 секунд
    setInterval(nextStock, 10000);
</script>

</body>
</html>

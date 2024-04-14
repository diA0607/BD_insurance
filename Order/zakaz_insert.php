<?php
session_start();

$mysql = mysqli_connect("localhost", "root", "", "new3333");
if (!$mysql) {
    die("Error connect to database!");
}

// Проверяем, была ли отправлена форма методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, есть ли необходимые данные в массиве $_POST
    if (isset($_POST["product_id"], $_POST["insurance_amount"], $_POST["start_date"], $_POST["insurance_term"], $_POST["id_client"])) {
        // Получаем массивы данных из формы
        $product_ids = $_POST["product_id"];
        $insurance_amounts = $_POST["insurance_amount"];
        $start_dates = $_POST["start_date"];
        $insurance_terms = $_POST["insurance_term"];
        $id_clients = $_POST["id_client"];

        // Подготавливаем запрос на добавление данных в таблицу корзина
        $query = "INSERT INTO корзина (Код_предмета_страхования, Сумма_страхования, Дата_создания, Срок_страхования, Код_клиента) VALUES (?, ?, ?, ?, ?)";
        
        // Подготавливаем выражение для выполнения запроса
        $stmt = mysqli_prepare($mysql, $query);
        
        // Проверяем, удалось ли подготовить запрос
        if ($stmt) {
            // Привязываем переменные к параметрам запроса
            mysqli_stmt_bind_param($stmt, "iisis", $product_id, $insurance_amount, $start_date, $insurance_term, $id_client);
            
            // Обрабатываем каждую строку заказа
            foreach ($product_ids as $key => $product_id) {
                // Получаем данные из текущей строки заказа
				$product_id = $product_ids[$key];
                $insurance_amount = $insurance_amounts[$key];
                $start_date = $start_dates[$key];
                $insurance_term = $insurance_terms[$key];
                $id_client = $id_clients[$key];
                
                // Выполняем запрос для текущей строки заказа
                $result = mysqli_stmt_execute($stmt);
                
                // Проверяем успешность выполнения запроса
                if (!$result) {
                    echo "Ошибка при добавлении данных в корзину: " . mysqli_error($mysql);
                    // Отменяем остальные запросы и выходим из цикла
                    break;
                }
            }
            
            // Закрываем выражение запроса
            mysqli_stmt_close($stmt);
        } else {
            echo "Ошибка при подготовке запроса: " . mysqli_error($mysql);
        }
    } else {
        echo "Не все необходимые данные были отправлены.";
    }
} else {
    echo "Доступ к этой странице разрешен только через метод POST.";
}

// Перенаправляем пользователя на главную страницу
header("Location: ../index.php");

// Закрываем соединение с базой данных
mysqli_close($mysql);

?>

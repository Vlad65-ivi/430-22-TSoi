<?php
session_start();
// Подключение к БД

// Проверка авторизации
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

$host = "localhost"; // Или IP-адрес сервера
$user = "root"; // Твой логин для БД
$password = ""; // Пароль для БД (оставь пустым, если нет)
$dbname = "project5"; // Имя БД

$conn = new mysqli($host, $user, $password, $dbname);

// Проверка на успешное подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Данные пользователя
$user_name = $_SESSION["user"];


// Запрос обращений пользователя
$stmt = $conn->prepare("SELECT id, number, description, status, date FROM requests WHERE user_id = ? ORDER BY date DESC");

if (!$stmt) {
    die("Ошибка запроса: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="user_dashboard.css?" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
</head>
<body>


<main>
    <div class="container1">  
    <img src="logo2.svg" style="position: absolute; left: 50px; top: 50px; width: 22%;"> 
        <!-- Модальное окно -->
        <div class="modal" id="modal">
            <div class="modal-content">
                
                <form action="handle_request.php" method="POST">
                    <label for="number" style="width: 205px; height: 49.00px; color: rgba(0, 0, 0, 1.00); font-family: Montserrat; font-weight: 400; padding: 0px 0px 0px 0px; position: absolute; top: 450px; left: 900px; text-align: left; font-size: 40px"> Описание</label>
                    <input id="description" name="description" required style="width: 750px; height: 200.00px; color: rgba(0, 0, 0, 1.00);  font-weight: 100; padding: 0px 0px 0px 0px; position: absolute; top: 520px; left: 900px; text-align: left; font-size: 70px"></input><br>
                    

                    <label for="description" style="width: 214px; height: 49.00px; color: rgba(0, 0, 0, 1.00); font-family: Montserrat; font-weight: 400; padding: 0px 0px 0px 0px; position: absolute; top: 300px; left: 900px; text-align: left; font-size: 40px"> Номер ТС:</label>
                    <input type="text" id="number" name="number" required style="width: 750px; height: 49.00px; color: rgba(0, 0, 0, 1.00); ; font-weight: 400; padding: 0px 0px 0px 0px; position: absolute; top: 360px; left: 900px; text-align: left; font-size: 40px"><br>
                    
                    

                    <button type="submit" required style="left: 1130px;"> Создать</button>   
                </form>
                <style>

                
            
    
        </style> 
            </div>
        </div>
    </div>
    
    
</main>

<script>
    function showModal() {
        document.getElementById('modal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>
</body>
</html>
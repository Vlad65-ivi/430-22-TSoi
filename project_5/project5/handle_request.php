<?php
session_start();


// Подключение к базе данных
$host = "localhost"; // Или IP-адрес сервера
$user = "root"; // Логин для БД
$password = ""; // Пароль для БД (оставь пустым, если нет)
$dbname = "project5"; // Имя БД

$conn = new mysqli($host, $user, $password, $dbname);

// Проверка соединения с базой данных
if ($conn->connect_error) {
    die("Ошибка соединения с базой данных: " . $conn->connect_error);
}

// Получаем данные из формы
$number = $_POST["number"];
$description = $_POST["description"];
$user_id = $_SESSION["user_id"];  // Получаем user_id из сессии

// Создаем запрос на вставку обращения
$stmt = $conn->prepare("INSERT INTO requests (number, description, status, user_id) VALUES (?, ?, 'Ожидает', ?)");
$stmt->bind_param("ssi", $number, $description, $user_id);

// Выполняем запрос
if ($stmt->execute()) {
    // Перенаправляем на профиль после успешного создания обращения
    header("Location: user_dashboard.php");
    exit();  // Не забывайте вызвать exit, чтобы код не продолжался
} else {
    // Вывод ошибки при неудачном добавлении
    echo "Ошибка при добавлении обращения: " . $stmt->error;
}

// Закрываем подготовленные запросы и соединение
$stmt->close();
$conn->close();
?>
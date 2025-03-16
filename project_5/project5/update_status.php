<?php
session_start();
 // Подключение к БД

$host = "localhost"; // Или IP-адрес сервера
$user = "root"; // Твой логин для БД
$password = ""; // Пароль для БД (оставь пустым, если нет)
$dbname = "project5"; // Имя БД

$conn = new mysqli($host, $user, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $request_id = $_POST["request_id"];
    $new_status = $_POST["status"];

    $stmt = $conn->prepare("UPDATE requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $request_id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php"); // Перезагрузка страницы
    } else {
        echo "Ошибка обновления";
    }
}
?>

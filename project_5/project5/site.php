<?php
session_start(); // Инициализация сессии

$host = 'localhost';
$dbname = 'project5';
$user = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST["username"]);
    $password = $_POST["password"];

    // Проверка для администратора
    if ($login === 'admin' && $password === 'admin_pass') {
        $_SESSION["user"] = "admin";  
        header("Location: admin_dashboard.php");
        die(); 
    }

    // Подготовка и выполнение запроса к базе данных
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $login]);
    $user = $stmt->fetch();

    // Проверка логина и пароля
    if ($user && $user["password"] === $password) {
        $_SESSION["user"] = $user["firstname"] . " " . $user["lastname"];
        header("Location: user_dashboard.php");
        die();
    } else {
        echo "<script>alert('Неверный логин или пароль!'); window.location.href='index.php';</script>";
    }
}
?>
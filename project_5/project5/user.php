<?php
$conn = new mysqli("localhost", "root", "", "project5");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$un = $_POST["username"];
$em = $_POST["email"];
$pass = $_POST["password"];
//$sql = "INSERT INTO users (username, email, password) VALUES ('$un', '$em', '$pass')";

$sql = "SELECT * FROM `users` WHERE (`username` = '$un' || `email` = '$em')";
//var_dump($result=mysqli_query($conn,$sql));
$result=mysqli_query($conn,$sql);


if ($result-> num_rows > 0) {
echo "<script>alert('Пользователь с такими данными уже существует!'); window.location.href='/'</script>";
} else {
    echo "okay";
    $sql = "INSERT INTO users (username, email, password) VALUES ('$un', '$em', '$pass')";
    if($conn->query($sql)){
        echo "<script>alert('Вы успешно зарегистрированы!'); window.location.href='index.php?user_id=$em&name=$un';</script>";
    } else{
        echo "Ошибка: " . $conn->error;
    }
}


$conn->close();


$name = "отсутствует";
$email = "отсутствует";
$password = "отсутствует";
if(isset($_POST["username"])){
  
    $name = $_POST["username"];
}

if(isset($_POST["email"])){
  
    $email = $_POST["email"];
}

if(isset($_POST["password"])){
  
    $password = $_POST["password"];
}

if(isset($_POST["username"])){
  
    $name = $_POST["username"];
}
echo "Логин: $name <br> Почта: $email <br> Пароль: $password";


?>
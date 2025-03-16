<?php

$host = 'localhost';
$dbname = 'project5';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

$query = "SELECT * FROM requests";
$stmt = $pdo->prepare($query);
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- <div style="width: 304px; height: 85.00px; color: rgba(0, 0, 0, 1.00); font-family: Montserrat; font-weight: 700; padding: 0px 0px 0px 0px; position: absolute; top: 295px; left: 808px; text-align: left; font-size: 69.65870666503906px"> Создать</div>
   <div style="width: 451px; height: 85.00px; color: rgba(0, 0, 0, 1.00); font-family: Montserrat; font-weight: 700; padding: 0px 0px 0px 0px; position: absolute; top: 865px; left: 734px; text-align: left; font-size: 69.65870666503906px"> Обращение</div>
   <div style="width: 205px; height: 49.00px; color: rgba(0, 0, 0, 1.00); font-family: Montserrat; font-weight: 400; padding: 0px 0px 0px 0px; position: absolute; top: 759px; left: 308px; text-align: left; font-size: 40px"> Номер ТС</div>
   <div style="width: 214px; height: 49.00px; color: rgba(0, 0, 0, 1.00); font-family: Montserrat; font-weight: 400; padding: 0px 0px 0px 0px; position: absolute; top: 636px; left: 308px; text-align: left; font-size: 40px"> Описание</div>
   <div class="container1"> -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет администратора</title>
    <link rel="stylesheet" href="admin_dashboard.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="Union.svg" type="ico">
</head>
<body>

<main>
    <div class="container1">
    <img src="logo2.svg" style="position: absolute; left: 50px; top: 50px; width: 22%;">
        <table>
            <tr>
                <th>ID</th>
                <th>Рег. номер</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Изменить статус</th>
            </tr>
            <?php foreach ($requests as $request): ?>
                
                <tr>
                    <td><?php echo $request["id"]; ?></td>
                    <td><?php echo $request["number"]; ?></td>
                    <td><?php echo $request["description"]; ?></td>
                    <td><?php echo $request["status"]; ?></td>
                    <td>
                        <form action="update_status.php" method="POST">
                        <select name="status">
                        <option value="Новое" <?php if (['status'] == 'Новое') echo 'selected'; ?>>Новое</option>
                        <option value="В работе" <?php if (['status'] == 'В работе') echo 'selected'; ?>>В работе</option>
                        <option value="Закрыто" <?php if (['status'] == 'Закрыто') echo 'selected'; ?>>Закрыто</option>
                        </select>
                            <input type="hidden" name="request_id" value="<?php echo $request["id"]; ?>">
                            <button type="submit">Сохранить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <style>
        
    
    </style>
</main>
</body>
</html>
<?php
$host = 'localhost';
$db = 'vp'; 
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

$recommendation = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $purpose = $_POST['purpose'];
    $budget = $_POST['budget'];
    $screen_size = $_POST['screen_size'];

    $stmt = $pdo->prepare("
        SELECT recommendation 
        FROM rules 
        WHERE purpose = :purpose 
          AND budget = :budget 
          AND screen_size = :screen_size
    ");
    $stmt->execute([
        ':purpose' => $purpose,
        ':budget' => $budget,
        ':screen_size' => $screen_size
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $recommendation = $result['recommendation'];
    } else {
        $recommendation = "Подходящей рекомендации не найдено. Попробуйте изменить параметры.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Экспертная система</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Экспертная система: Выбор ноутбука</h1>
        <form method="POST" action="">
            <label for="purpose">Назначение:</label>
            <select name="purpose" id="purpose" required>
                <option value="Работа">Работа</option>
                <option value="Игры">Игры</option>
                <option value="Учеба">Учеба</option>
                <option value="Дизайн">Дизайн</option>
                <option value="Разработка ПО">Разработка ПО</option>
            </select>
            
            <label for="budget">Бюджет:</label>
            <select name="budget" id="budget" required>
                <option value="до 500$">до 500$</option>
                <option value="500-1000$">500-1000$</option>
                <option value="1000-1500$">1000-1500$</option>
                <option value="1500-2000$">1500-2000$</option>
                <option value="более 2000$">более 2000$</option>
            </select>
            
            <label for="screen_size">Диагональ экрана:</label>
            <select name="screen_size" id="screen_size" required>
                <option value="13-14 дюймов">13-14 дюймов</option>
                <option value="15-16 дюймов">15-16 дюймов</option>
                <option value="17 и более">17 и более</option>
            </select>
            
            <button type="submit">Получить рекомендацию</button>
        </form>

        <?php if ($recommendation): ?>
            <div class="result">Рекомендация: <?= htmlspecialchars($recommendation) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Функция для получения реального IP-адреса пользователя
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Получаем IP-адрес
$visitor_ip = getRealIP();

// Дополнительная информация
$date = date('Y-m-d H:i:s');
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Прямой заход';

// Формируем строку для записи
$log_entry = "IP: $visitor_ip | Дата: $date | User-Agent: $user_agent | Реферер: $referer\n";

// Записываем в файл
file_put_contents('visitors.log', $log_entry, FILE_APPEND);

// HTML страница
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать на наш сайт!</h1>
        <p>Спасибо за посещение. Ваш IP-адрес и другая информация были сохранены.</p>
        <p>Техническая информация:</p>
        <ul>
            <li>Ваш IP-адрес: <?php echo htmlspecialchars($visitor_ip); ?></li>
            <li>Дата и время: <?php echo htmlspecialchars($date); ?></li>
            <li>Браузер: <?php echo htmlspecialchars($user_agent); ?></li>
        </ul>
    </div>
</body>
</html>

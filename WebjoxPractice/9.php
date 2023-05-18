<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9</title>
</head>
<body>
    <?php
        $url = "https://wm-school.ru/php/php_exercises.php";
        //$url = "https://www.programulin.ru/tipy-dannyh-v-php";
        $protocol = parse_url($url, PHP_URL_SCHEME);
        $host = parse_url($url, PHP_URL_HOST);
        $path = parse_url($url, PHP_URL_PATH);

        echo "Ссылка: $url <br>";
        echo "Протокол: $protocol <br>";
        echo "Хост: $host <br>";
        echo "Путь: $path <br>";
    ?>
</body>
</html>

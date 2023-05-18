<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>32</title>
</head>
<body>
    <?php
        $a = 20;
        $b = 50;

        echo "Переменные перед заменой: <br>";
        echo "a = $a <br>";
        echo "b = $b <br>";

        echo "Переменные после замены: <br>";

        $t = $a;
        $a = $b;
        $b = $t;

        echo "a = $a <br>";
        echo "b = $b <br>";
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>
</head>
<body>
    <?php
        $sum = 0;
        for($i = 1; $i <= 30; $i++){
            $sum += $i;
        }
        echo "Сумма чисел от 1 до 30 равна $sum";
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7</title>
</head>
<body>
    <?php
        $str = "www.wm-school.ru";
        $char = 'w';
        $count = 0;
        for ($i = 0; $i < strlen($str); $i++){
            if($str[$i] == $char){
                $count++;
            }
        }
        echo "Количество символов '$char' в строке $str равно $count <br>";
    ?>
</body>
</html>
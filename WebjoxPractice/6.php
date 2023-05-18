<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6</title>
</head>
<body>
    <?php
        //является ли IP из общего Интернета
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //является ли ip от прокси
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //является ли ip с удаленного адреса
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        echo "Ваш ip-адрес: $ip";
    ?>
</body>
</html>
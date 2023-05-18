<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24</title>
</head>
<body>
    <?php
        if (version_compare(PHP_VERSION, '7.2.0') > 0){
            echo "Моя версия PHP больше версии 7.2.0";
        }
        elseif(version_compare(PHP_VERSION, '7.2.0') == 0){
            echo "Моя версия PHP 7.2.0";
        }
        else{
            echo "Моя версия PHP меньше версии 7.2.0";
        }
            
        
            
    ?>
</body>
</html>
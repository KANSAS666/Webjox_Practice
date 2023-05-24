<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5</title>
</head>
<body>
    <?php
        function f($n){
            $p = 1;
            for($i = $n; $i >= 1; $i--){
                $p *= $i;
            }
            return "Факториал $n равен $p <br>";
        }
        echo f(6);
        echo f(4);
        echo f(5);
        echo f(0);

    ?>
    
</body>
</html>
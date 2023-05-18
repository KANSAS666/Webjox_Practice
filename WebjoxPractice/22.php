<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>22</title>
</head>
<body>
    <?php
        function checkNumber($x){
            $check = $x > 30 ? "Больше, чем 30" : ($x > 20 ? "Больше, чем 20" : ($x > 10 ? "Больше, чем 10" : "Введите число не менее 10!"));
            echo "{$x}: ".$check."<br>";
        }

        $x = 7;
        $y = 11;
        $z = 21;
        $c = 31;
        checkNumber($c);
        checkNumber($z);
        checkNumber($y);
        checkNumber($x);
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>12</title>
</head>
<body>
    <?php
        function triangle($n){

        echo "n = " . $n . "<br>";
        echo "<br>";
        $count = 1;
        for ($i = $n; $i > 0; $i--) 
        {
            for ($j = $i; $j < $n + 1; $j++) 
            {
            echo "$count ";
            $count++;
            } 
            echo "<br>";
        }
    }

    echo triangle(5).'<br>';
    echo triangle(7);
    ?>
</body>
</html>
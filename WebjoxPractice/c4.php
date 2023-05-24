<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4</title>
</head>
<body>
    <?php
        $n=5;
        for($i=1; $i<=$n; $i++)
        {
            for($j=1; $j<=$i; $j++)
            {
                echo ' * ';
            }
        echo '<br>';
        }

        for($i=$n; $i>=1; $i--)
        {
            for($j=1; $j<=$i; $j++)
            {
                echo ' * ';
            }
        echo '<br>';
        }
    ?>
</body>
</html>
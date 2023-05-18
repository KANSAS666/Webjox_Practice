<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите число:</label>
        <input type="nubmer" name="n" style="margin-bottom: 5px;"> <br>
        <button type="submit" name="submit" style="margin-bottom: 5px;">Отправить</button>
    </form>
    <?php
        function substraction($n){
            $result = $n > 51 ? ($n - 51) * 3 : 51 - $n;
            return "$result <br>";
        }
        if(isset($_POST['submit']))
        {
            $n = $_POST['n'];
            if ($n > 51){
                echo "Тройная разница числа $n и числа 51 равна ".substraction($n);
            }
            else{
                echo "Разница числа $n и числа 51 равна ".substraction($n);
            }
        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите первое число:</label>
        <input type="nubmer" name="n1" style="margin-bottom: 5px;" required> <br>
        <label>Введите второе число:</label>
        <input type="nubmer" name="n2" style="margin-bottom: 5px;" required> <br>
        <button type="submit" name="submit" style="margin-bottom: 5px;">Отправить</button>
    </form>
    <?php
        function sumNumbers($n1,$n2){
            $result = $n1 == $n2 ? ($n1 + $n2) * 3 : $n1 + $n2;
            return "$result <br>";
        }
        if(isset($_POST['submit']))
        {
            $n1 = $_POST['n1'];
            $n2 = $_POST['n2'];
            if ($n1 != $n2){
                echo "Итоговая сумма двух разных чисел: ".sumNumbers($n1, $n2);
            }
            else{
                echo "Тройная сумма двух одинаковых чисел: ".sumNumbers($n1, $n2);
            }
        }
    ?>
</body>
</html>
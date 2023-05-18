<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите число:</label>
        <input type="nubmer" name="n" style="margin-bottom: 5px;" required> <br>
        <button type="submit" name="submit" style="margin-bottom: 5px;">Отправить</button>
    </form>

    <?php
        function checkNumber($n){
            if ($n % 3 == 0 || $n % 7 == 0){
                //return "Число $n кратно 3 или 7 <br>";
                return true;
            }
            else{
                //return "Число не делится на 3 и на 7 без остатка";
                return false;
            }
        }

        if (isset($_POST['submit'])){
            $n = $_POST['n'];
            var_dump(checkNumber($n));
        }
    ?>
</body>
</html>
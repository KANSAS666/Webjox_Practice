<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите число:</label>
        <input type="nubmer" name="n" style="margin-bottom: 5px;" required> <br>
        <button type="submit" name="submit" style="margin-bottom: 5px;">Отправить</button>
    </form>

    <?php
        function checkNumber($n){
            if(abs($n - 100) <= 10 || abs($n - 200) <= 10)
                return true;
            return false;
        }

        if(isset($_POST['submit'])){

            $n = $_POST['n'];
            var_dump(checkNumber($n));
        }
    ?>
</body>
</html>
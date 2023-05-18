<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3</title>
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
        function checkNumber($n1, $n2){
            if($n1 == 30){
                return true;
            }
            elseif ($n2 == 30){
                return true;
            }
            elseif($n1 + $n2 == 30){
                return true;
            }
            else{
                return false;
            }
        }

        if(isset($_POST['submit'])){

            $n1 = $_POST['n1'];
            $n2 = $_POST['n2'];

            var_dump(checkNumber($n1,$n2));
        }
    ?>
</body>
</html>
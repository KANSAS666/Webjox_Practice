<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите строку:</label>
        <input type="text" name="str" style="margin-bottom: 5px;" required> <br>
        <button type="submit" name="submit" style="margin-bottom: 5px;">Отправить</button>
    </form>

    <?php
        function reverseStr($str){
            return strlen($str) > 1 ? substr($str, strlen($str) - 1).substr($str, 1, strlen($str) - 2). substr($str, 0, 1) : $str;
        }

        if (isset($_POST['submit'])){
            $str = $_POST['str'];
            echo reverseStr($str);
        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите строку:</label>
        <input type="text" name="str" style="margin-bottom: 5px;" required> <br>
        <button type="submit" name="submit" style="margin-bottom: 5px;">Отправить</button>
    </form>

    <?php
        function newChars($str){
            $lastChar = substr($str, strlen($str) - 1);
            $newStr = $lastChar.$str.$lastChar;
            return $newStr.'<br>';
        }

        if (isset($_POST['submit'])){
            $str = $_POST['str'];
            echo newChars($str);
        }
    ?>
</body>
</html>
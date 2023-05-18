<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите строку:</label>
        <input type="text" name="str" style="margin-bottom: 5px;" required> <br>
        <label>Введите число:</label>
        <input type="number" name="k" style="margin-bottom: 5px; margin-left: 6px;" required> <br>
        <button type="submit" name="submit" style="margin-bottom: 5px;">Отправить</button>
    </form>

    <?php
        function deleteChar($str, $k){
            return substr($str, 0, $k).substr($str,$k+1,strlen($str)-$k).'<br>';
        }

        if (isset($_POST['submit'])){
            $str = $_POST['str'];
            $k = $_POST['k'];
            echo deleteChar($str, $k);
        }
    ?>
</body>
</html>
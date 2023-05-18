<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>13</title>
</head>
<body>
    <form method="POST" action="">
        <label>Введите свой email: </label>
        <input type="text" name="email"> <br>
        <button type="submit" name="submit">Отправить</button>
    </form>
    <?php 
        if (isset($_POST['submit'])){
            
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            echo 'Email: '.$email.' введен верно'."\n";
        }
        else 
        {
            echo 'Email: '.$email.' введен неверно'."\n";
        }
    }
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5</title>
    <style>
        label, input{
            margin-bottom: 10px;
        }
        button {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
		<label>Как вас зовут?</label> <br>
		<input type="text" name="username"> <br>
		<button type="submit" name="submit">Отправить</button>
	</form>
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['username'];
        if ($name != null)
        {
            echo "Приветсвтую тебя, $name!";
        }
        else{
            echo "Введите свое имя!";
        }
    }
?>
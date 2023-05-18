<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>31</title>
</head>
<body>
    <?php
        //echo "Время последней модификации текущей страницы: " . date ("F d Y H:i:s.", getlastmod());
    ?>
    <?php
setlocale(LC_TIME, "ru_RU.utf8"); // Устанавливаем локаль на русский язык
echo "Время последней модификации текущей страницы: " . date("d-m-y, H:i", getlastmod());
?>
</body>
</html>
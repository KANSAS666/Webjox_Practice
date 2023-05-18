<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8</title>
</head>
<body>
    <?php
        $current_file_name = basename($_SERVER['PHP_SELF']);
        echo "Название данного файла: $current_file_name";
    ?>
</body>
</html>
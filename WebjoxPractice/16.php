<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>16</title>
</head>
<body>
    <?php
        $current_file_name = basename($_SERVER['PHP_SELF']);
        $file_last_modified = filemtime($current_file_name); 
        echo "Последнее изменение файла {$current_file_name}: " . date("d-m-y, H:i", $file_last_modified) . "\n";  
    ?>
</body>
</html>
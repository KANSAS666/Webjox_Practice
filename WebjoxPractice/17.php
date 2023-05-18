<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>17</title>
</head>
<body>
    <?php
        //$file = basename($_SERVER['PHP_SELF']); 
        $file = "D:\\Study Data\\OpenServer\\OSPanel\\domains\\WebjoxPractice\\file\\17.txt";
        $filename = "17.txt";
        $countOfLines = count(file($file)); 
        echo "Файл $filename содержит количесвто строк, равное $countOfLines "."\n";
    ?>




</body>
</html>
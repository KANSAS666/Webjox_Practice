<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>15</title>
</head>
<body>
    <?php
        $all_lines = file('https://wm-school.ru/');
        foreach ($all_lines as $line_num => $line)
        {
        echo "Line No.-{$line_num}: " . htmlspecialchars($line) . "\n";
        }
?> 
</body>
</html>
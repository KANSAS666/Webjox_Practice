<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7</title>
</head>
<body>
<?php 
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    // Определение операционной системы
    if (preg_match('/windows/i', $user_agent)) {
        $os = 'Windows';
    } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
        $os = 'Mac';
    } elseif (preg_match('/linux/i', $user_agent)) {
        $os = 'Linux';
    } 
      else {
        $os = 'Unknown';
    }

    // Определение браузера
    if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
        $browser = 'Internet Explorer';
    } elseif (preg_match('/Firefox/i', $user_agent)) {
        $browser = 'Firefox';
    } elseif (preg_match('/Chrome/i', $user_agent)) {
        $browser = 'Chrome';
    } elseif (preg_match('/Safari/i', $user_agent)) {
        $browser = 'Safari';
    } elseif (preg_match('/Opera/i', $user_agent)) {
        $browser = 'Opera';
    } elseif (preg_match('/Netscape/i', $user_agent)) {
        $browser = 'Netscape';
    } else {
        $browser = 'Unknown';
    }

    echo "Your-User Agent is: $user_agent <br>";
    echo "Your OS is: $os <br>";
    echo "Your Browser is: $browser <br>";
?>
</body>
</html>

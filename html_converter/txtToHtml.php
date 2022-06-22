<?php
    $html = file_get_contents('testTxtToHtml.txt');
    preg_match_all('/\S+.+\S+/',$html, $matches);
    $text = '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    ';
    foreach ($matches[1] as $match) $text .= '<div>'.$match.'</div>'."\n";
    $text .= '
</body>
</html>';
    file_put_contents('testTxtToHtml.html', $text);

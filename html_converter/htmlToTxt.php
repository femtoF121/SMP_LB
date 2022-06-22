<?php
    $html = file_get_contents('testHtmlToTxt.html');
    preg_match_all('/>(\S+)</',$html, $matches);
    $text = '';
foreach ($matches[1] as $match) $text .= $match . "\n";
file_put_contents('testHtmlToTxt.txt', $text);
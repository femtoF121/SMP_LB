<?php

function AnalyseLogs () {
    $text = file_get_contents($_SERVER['DOCUMENT_ROOT']."/logs.txt");
    $ip = $_SERVER['REMOTE_ADDR'];
    preg_match_all("/(.+) - IP: $ip \| .+Referrer: (.+) \| Username: (.+)/", $text, $matches);

    return ["Date: ".date('d.m.y  H:i:s' ,strtotime($matches[1][count($matches[1])-1])), "Action: ". $matches[2][count($matches[2])-1], "Username: ".$matches[3][count($matches[3])-1]];
}
<?php

function CheckMail($str): bool
{
    preg_match('/\w{3,25}@[a-z]+\.[a-z]+/', $str , $matches);

    if (count($matches) != 0) return true;
    return false;
}

function IsPasswordValid($pass) {
    return preg_match('/\S{8,}/', $pass);
}

function CheckPass($pass): string
{
    if(!IsPasswordValid($pass)) return 'Password should be at least 8 chars';
    if(!preg_match("/(\d+)/", $pass)) return 'There is no digit';
    if(!preg_match("/([a-z]+)/", $pass)) return 'There is no small letter';
    if(!preg_match("/([A-Z]+)/", $pass)) return 'There is no capital letter';
    if(!preg_match("/\W/", $pass)) return 'There is no special symbols';

    return 'ok';
}
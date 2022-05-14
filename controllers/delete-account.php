<?php
require_once 'DB.php';

session_start();

$db = new DB();
$db->openConnection();

$res = $db->deleteRows('users', ["column" => 'user_id', "value" => $_SESSION['currentUser']['user_id']]);

$db->closeConnection();
$res ? header("Location: logout.php") : header("Location: index.php");
die();
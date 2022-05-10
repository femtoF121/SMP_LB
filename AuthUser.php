<?php
require_once "DB.php";

session_start();

$db = new DB();

function loginUser($db, $email, $password) {
    $props = [
        ":email" => $email,
        ":pass" => $password
    ];
    $res = $db->execute("SELECT * from users WHERE email = :email AND password = :pass", $props);
    if($res) {
        $_SESSION['currentUser'] = $res[0];
    }
    else {
        $_SESSION['authError'] = 'No such user';
    }
    header("Location: index.php");
    die();
}

if(!empty($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['typeOfAuth'])) {

    $db->openConnection();

    if($_POST['typeOfAuth'] == 'login'){
        loginUser($db, $_POST['email'], $_POST['pass']);
    }
    else if($_POST['typeOfAuth'] == 'signup') {
        $props = [
            ":email" => $_POST['email'],
            ":pass" => $_POST['pass']
        ];
        $res = $db->execute("INSERT INTO users (email, password) VALUES (:email, :password)", $props);
        if($res) {
            loginUser($db, $_SESSION['email'], $_SESSION['pass']);
        }
        else {
            $_SESSION['authError'] = 'Sorry, there is some problems';
            header("Location: index.php");
            die();
        }
    }
    else {
        $_SESSION['authError'] = 'Sorry, there is some problems';
    }

    $db->closeConnection();
}
else {
    $_SESSION['authError'] = 'There shouldn\'t be empty fields';
}

header('Location: index.php');
die();
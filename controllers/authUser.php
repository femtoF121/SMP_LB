<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DB.php";
require_once $_SERVER['DOCUMENT_ROOT']."/functions/checks.php";

session_start();

$db = new DB();

function loginUser($db, $email, $password)
{
    if(!CheckMail($email)) {
        $_SESSION['authError'] = 'Invalid email';
        header("Location: ../views/authLayout.php");
        die();
    }
    $props = [
        ":email" => $email,
        ":pass" => $password
    ];
    $res = $db->execute("SELECT * from users WHERE email = :email AND password = :pass", $props);
    if (count($res) != 0) {
        $_SESSION['currentUser'] = $res[0];
    } else {
        $_SESSION[' authError'] = 'No such user';
    }
    header("Location: ../views/authLayout.php");
    die();
}

if (!empty($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['typeOfAuth'])) {

    $db->openConnection();

    if ($_POST['typeOfAuth'] == 'login') {
        loginUser($db, $_POST['email'], $_POST['pass']);
    } else if ($_POST['typeOfAuth'] == 'signup') {
        if(!CheckMail($_POST['email'])) {
            $_SESSION['authError'] = 'Invalid email';
            header("Location: ../views/authLayout.php?typeOfAuth=signup");
            die();
        }
        $checkPass = CheckPass($_POST['pass']);
        if($checkPass != 'ok') {
            $_SESSION['authError'] = $checkPass;
            header("Location: ../views/authLayout.php?typeOfAuth=signup");
            die();
        }
        $suchUser = $db->execute("SELECT * FROM users WHERE email = :email", [":email" => $_POST['email']]);
        if($suchUser) {
            $_SESSION['authError'] = 'There is user with this email';
            header("Location: ../index.php");
            die();
        }
        $props = [
            ":email" => $_POST['email'],
            ":pass" => $_POST['pass']
        ];
        $db->execute("INSERT INTO users (email, password) VALUES (:email, :pass)", $props);

        loginUser($db, $_POST['email'], $_POST['pass']);

    } else {
        $_SESSION['authError'] = 'Sorry, there is some problems2';
    }

    $db->closeConnection();
} else {
    $_SESSION['authError'] = 'There shouldn\'t be empty fields';
}

header('Location: ../index.php');
die();
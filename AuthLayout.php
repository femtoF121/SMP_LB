<?php
session_start();

if(isset($_GET['typeOfAuth'])) {
    if($_GET['typeOfAuth'] == 'login') {
        $typeOfAuth = 'login';
    }
    else {
        $typeOfAuth = 'signup';
    }
}
else {
    $typeOfAuth = 'login';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CookDise Auth</title>
</head>
<body>
<div class="container">
    <form method="post" action="AuthUser.php">
        <h2 style="color: red">
            <?php if(!empty($_SESSION['authError'])) {
                echo $_SESSION['authError'];
                unset($_SESSION['authError']);
            }
              ?>
        </h2>
        <input type="hidden" name="typeOfAuth" value="<?php echo $typeOfAuth ?>">
        <label>
            Email
            <input name="email" placeholder="misha@gmail.com" />
        </label>
        <label>
            Password
            <input name="pass" type="password" placeholder="****">
        </label>
        <button type="submit"><?php echo strtoupper($typeOfAuth) ?></button>
    </form>
    <form method="get" action="AuthLayout.php">
        <input type="hidden" name="typeOfAuth" value="<?php echo $typeOfAuth == 'login' ? 'signup' : 'login' ?>">
        <button type="submit"><?php echo $typeOfAuth == 'login' ? 'Signup' : 'Login' ?></button>
    </form>
</div>
</body>
</html>

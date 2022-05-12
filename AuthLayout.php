<?php
session_start();

if(isset($_SESSION['currentUser'])) {
    header('Location: index.php');
    die();
}

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
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CookDise Auth</title>
</head>
<body>
    <div class="auth__container">
        <div class="forms__card">
            <form method="post" action="AuthUser.php" class="auth__form" >
                <h5 style="color: red">
                    <?php if(!empty($_SESSION['authError'])) {
                        echo $_SESSION['authError'];
                        unset($_SESSION['authError']);
                    }
                      ?>
                </h5>
                <input type="hidden" name="typeOfAuth" value="<?php echo $typeOfAuth ?>">
                <label class="form-label">
                    Email
                    <input name="email" placeholder="Email" class="form-control"/>
                </label>
                <label class="form-label">
                    Password
                    <input name="pass" type="password" placeholder="Password" class="form-control">
                </label>
                <button type="submit" class="btn btn-primary" style="background-color: #66B54E; border-color: #66B54E;"><?php echo strtoupper($typeOfAuth) ?></button>
            </form>
            <form method="get" action="AuthLayout.php">
                <input type="hidden" name="typeOfAuth" value="<?php echo $typeOfAuth == 'login' ? 'signup' : 'login' ?>">
                <button type="submit" style="display: block; margin: 0 auto" class="btn btn-link"><?php echo $typeOfAuth == 'login' ? 'Signup' : 'Login' ?></button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/RecipesModel.php';

session_start();

if (!empty($_POST['title']) &&
    !empty($_POST['time'])  &&
//    !empty($_FILES['recipeImage']) &&
    !empty($_POST['description']) &&
    !empty($_POST['ingredients']) &&
    !empty($_POST['steps'])
    //&&
//    !empty($_FILES['stepImages'])
) {
    $recipe = [
        'title' => $_POST['title'],
        'time' => $_POST['time'],
        'recipeImage' => $_POST['recipeImage'],
        'description' => $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'steps' => $_POST['steps'],
    ];

    $res = insertRecipe($_SESSION['currentUser']['user_id'], $recipe);

    if($res) {
        $_SESSION['add-recipe-success'] = 'Successfully added new recipe!';
        header('Location: ../index.php');
        die();
    }
    else {
        $_SESSION['add-recipe-error'] = 'Something went wrong';
        header('Location: ../views/adding-recipe-page.php');
        die();
    }

} else {
    $_SESSION['add-recipe-error'] = 'All fields should be filled';
    header('Location: ../views/adding-recipe-page.php');
    die();
}

?>

<!--<h3 style="color: green">--><?php //echo $_SESSION['add-recipe-success']; unset($_SESSION['add-recipe-success']) ?><!--</h3>-->
<!--<h3 style="color: red">--><?php //echo $_SESSION['add-recipe-error']; unset($_SESSION['add-recipe-error']) ?><!--</h3>-->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/RecipesModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/file.php';

session_start();

if (!empty($_POST['title']) &&
    !empty($_POST['time'])  &&
    !empty($_FILES['recipeImage']) &&
    !empty($_POST['description']) &&
    !empty($_POST['ingredients']) &&
    !empty($_POST['steps']) &&
    !empty($_FILES['steps'])
) {

    echo "<pre>";
    echo "RECIPE IMAGE      ";
    print_r($_FILES['recipeImage']);
    echo "</pre>";

    echo "<pre>";
    echo "STEP IMAGE      ";
    print_r($_FILES['steps']);
    echo "</pre>";

    $resRecipePhoto = uploadFile($_FILES['recipeImage'], 'recipes', 'recipe-');

    if(!$resRecipePhoto) {
        $_SESSION['add-recipe-error'] = 'Add recipe photo';
        header('Location: ../views/adding-recipe-page.php');
        die();
    }

    $steps = [];

    for ($i = 0; $i < count($_FILES['steps']['name']); $i++) {
        $image = [];
        foreach ($_FILES['steps'] as $key=>$value) {
            $image[$key] = $value[$i];
        }

            print_r($image);
            $resStepImage = uploadFile($image, 'steps', 'step-');

        if(!$resStepImage) {
            $_SESSION['add-recipe-error'] = 'All steps should have a photo';
            header('Location: ../views/adding-recipe-page.php');
            die();
        }

        $steps[] = ['description' => $_POST['steps'][$i], 'stepImage' => '/' . $resStepImage];
    }

    $recipe = [
        'title' => $_POST['title'],
        'time' => $_POST['time'],
        'photo' => '/' . $resRecipePhoto,
        'description' => $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'steps' => $steps,
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

<!--<pre>-->
<!--    --><?php //print_r($_POST) ?>
<!--    <br>-->
<!--    <br>-->
<!--    --><?php //print_r($_FILES) ?>
<!--</pre>-->

<!--<h3 style="color: green">--><?php //echo $_SESSION['add-recipe-success']; unset($_SESSION['add-recipe-success']) ?><!--</h3>-->
<!--<h3 style="color: red">--><?php //echo $_SESSION['add-recipe-error']; unset($_SESSION['add-recipe-error']) ?><!--</h3>-->

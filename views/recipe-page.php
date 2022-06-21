<?php
require_once "../RecipePage.php";
require_once "../models/RecipesModel.php";

if(!isset($_SESSION['currentUser'])){
    header("Location: authLayout.php");
    die();
}

$recipe = null;

foreach ($_SESSION['recipes'] as $item) {
    if($_POST['currentRecipeId'] == $item['id']) {
        $recipe = $item;
        break;
    }
}

if($recipe == null) {
    die("No such recipe");
}

$page = new RecipePage(true, $_SESSION['currentUser'], $recipe);

$page->loadPage();
<?php
require_once "MainPage.php";
require_once "models/RecipesModel.php";

if(isset($_SESSION['currentUser'])) {
    $recipes = getAllRecipes();
    $_SESSION['recipes'] = $recipes;

    $page = new MainPage(true, $_SESSION['currentUser']);
    $page->showStatistics();
    $page->loadPage();
}
else {
    header('Location: views/authLayout.php');
    die();
}



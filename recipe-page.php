<?php
require_once "RecipePage.php";
require_once "models/RecipesModel.php";

$currentUser = [
    "name" => "Misha",
    "email" => "mishamak@gmail.com",
    "photo" => "images/avatar.jpeg",
    "password" => "123123123",
    "recipes" => recipes_getAll()
];

$recipe = null;

foreach ($currentUser['recipes'] as $item) {
    if($_POST['currentRecipeId'] == $item['id']) {
        $recipe = $item;
        break;
    }
}

if($recipe == null) {
    die("No such recipe");
}

$page = new RecipePage(true, $currentUser, $recipe);

$page->loadPage();
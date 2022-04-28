<?php
require_once "db.php";
require_once "RecipePage.php";

$currentUser = [
    "name" => "Misha",
    "email" => "mishamak@gmail.com",
    "photo" => "images/avatar.jpeg",
    "password" => "123123123",
    "recipes" => getCurrentUserRecipes()
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
<?php
require_once "MainPage.php";
require_once "models/RecipesModel.php";

session_start();

if(isset($_SESSION['currentUser'])) {
    $recipes = recipes_getAll();
    $_SESSION['recipes'] = $recipes;

    $page = new MainPage(true, $_SESSION['currentUser']);

    $page->loadPage();
}
else {
    header('Location: AuthLayout.php');
    die();
}

$currentUser = [
    "name" => "Misha",
    "email" => "mishamak@gmail.com",
    "photo" => "images/avatar.jpeg",
    "password" => "123123123",
    "recipes" => recipes_getAll()
];
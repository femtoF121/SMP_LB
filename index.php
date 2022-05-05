<?php
require_once "MainPage.php";
require_once "models/RecipesModel.php";

$currentUser = [
    "name" => "Misha",
    "email" => "mishamak@gmail.com",
    "photo" => "images/avatar.jpeg",
    "password" => "123123123",
    "recipes" => recipes_getAll()
];

$page = new MainPage(true, $currentUser);

$page->loadPage();
<?php
require_once "db.php";
require_once "MainPage.php";

$currentUser = [
    "name" => "Misha",
    "email" => "mishamak@gmail.com",
    "photo" => "images/avatar.jpeg",
    "password" => "123123123",
    "recipes" => getCurrentUserRecipes()
];

$page = new MainPage(true, $currentUser);

$page->loadPage();
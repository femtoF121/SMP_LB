<?php
require_once "db.php";
require_once "MainPage.php";

$currentUser = [
    "name" => "Misha",
    "email" => "mishamak@gmail.com",
    "photo" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Ffilmix.ac%2Ffilmi%2Fdrama%2F6241-avatar-2009.html&psig=AOvVaw1V-61X6f87RmGvUAw1RSQi&ust=1650579979062000&source=images&cd=vfe&ved=0CAkQjRxqFwoTCNib3ujXo_cCFQAAAAAdAAAAABAD",
    "password" => "123123123",
    "recipes" => getCurrentUserRecipes()
];

$page = new MainPage(true, $currentUser);

$page->loadPage();
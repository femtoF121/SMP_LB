<?php
require 'db.php';

$id = $_POST['currentRecipe'];

$recipes = getCurrentUserRecipes();

$currentRecipe = null;

foreach ($recipes as $item) {
    if($item['id'] == $id) {
        $currentRecipe = $item;
    }
}

if($currentRecipe == null) {
    die("No such recipe");
}

$currentRecipe = new Recipe($currentRecipe['id'], $currentRecipe['title'], $currentRecipe['photo'], $currentRecipe['description'], $currentRecipe['steps'], $currentRecipe['time'], $currentRecipe['likes'], $currentRecipe['views']);

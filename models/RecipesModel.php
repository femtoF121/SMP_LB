<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DB.php";

function getAllRecipes(): array
{
    $db = new DB();
    $db->openConnection();

    $recipes = $db->getTable('recipes');
    $editedRecipes = [];

    foreach ($recipes as $recipe) {
        $ingredients = $db->execute("SELECT * from ingredients WHERE recipe_id = :recipeId", [":recipeId" => $recipe['id']]);
        $recipe['ingredients'] = $ingredients;

        $steps = $db->execute("SELECT * from steps WHERE recipe_id = :recipeId", [":recipeId" => $recipe['id']]);
        $recipe['steps'] = $steps;
        $editedRecipes[] = $recipe;
    }

    $db->closeConnection();

    return $editedRecipes;
}

function recipe_insert($user, $recipe) {

}

function getRecipesOfUser($user) {

}
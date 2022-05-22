<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/DB.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/sql.php";

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

function insertRecipe($userId, $recipe): bool
{

    $recipeId = uniqid('');
    $params = [
        [
            ":recipe_id" => $recipeId,
            ":title" => $recipe['title'],
            ":desc" => $recipe['description'],
            ":ingredients" => $recipe['ingredients'],
            ":time" => $recipe['time'],
            ":userId" => $userId
        ]
    ];

    $sqls = [
        "INSERT INTO recipes (id, title, description, time, ingredients, user_id) VALUES (:recipe_id, :title, :desc, :time, :ingredients, :userId)",
    ];

    for ($i = 0; $i < count($_POST['steps']); $i++) {
        $sqls[] = "INSERT INTO steps (recipe_id, step_number, description) VALUES (:recipeId, :stepNum, :desc)";
        $params[] = [":recipeId" => $recipeId, ":stepNum" => $i + 1, ":desc" => $recipe['steps'][$i]];
    }

    $res = Sql_transaction($sqls, $params);

    return $res;
}

function getRecipesOfUser($user)
{

}
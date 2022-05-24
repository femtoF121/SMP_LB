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
            ":photo" => $recipe['photo'],
            ":ingredients" => $recipe['ingredients'],
            ":time" => $recipe['time'],
            ":userId" => $userId
        ]
    ];

    $sqls = [
        "INSERT INTO recipes (id, title, description, time, ingredients, user_id, photo) VALUES (:recipe_id, :title, :desc, :time, :ingredients, :userId, :photo)",
    ];

    for ($i = 0; $i < count($recipe['steps']); $i++) {
        $sqls[] = "INSERT INTO steps (recipe_id, step_number, description, photo) VALUES (:recipeId, :stepNum, :desc, :photo)";
        $params[] = [":recipeId" => $recipeId, ":stepNum" => $i + 1, ":desc" => $recipe['steps'][$i]['description'], ":photo" => $recipe['steps'][$i]['stepImage']];
    }

    $res = Sql_transaction($sqls, $params);

    return $res;
}

function getRecipesOfUser($user)
{

}
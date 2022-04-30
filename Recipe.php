<?php

class Recipe
{
    private $id;
    private $title;
    private $photo;
    private $description;
    private $steps;
    private $time;
    private $likes;
    private $views;
    private $recipeArr;

    public function __construct($recipe) {
        $this->id = $recipe['id'];
        $this->title = $recipe['title'];
        $this->photo = $recipe['photo'];
        $this->description = $recipe['description'];
        $this->steps = $recipe['steps'];
        $this->time = $recipe['time'];
        $this->likes = $recipe['likes'];
        $this->views = $recipe['views'];
        $this->recipeArr = $recipe;
    }

    public function renderRecipeCard() {
        echo "
<div class='col'>
    <div class='card' style='width: 18rem;'>
        <form method='post' action='recipe-page.php'>
            <img src='$this->photo' class='card-img-top' alt='$this->title'>
            <input type='hidden' name='currentRecipeId' value='$this->id'>
            <div class='card-body'>
                <h5 class='card-title'>$this->title</h5>
                <p class='card-text'>$this->description</p>
                <button type='submit' class='btn cardBtn'>Open</button>
            </div>
        </form>
    </div>
</div>
";
    }

    private function goToRecipePage() {
        $page = new RecipePage($this->recipeArr);
    }

    public function renderOpenedRecipe() {
        echo "
<div>
    $this->id;
</div>        
";
    }
}

?>





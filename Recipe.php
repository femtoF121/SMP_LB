<?php

class Recipe
{
    private $id;
    private $title;
    private $photo;
    private $description;
    private $ingredients;
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
        $this->ingredients = $recipe['ingredients'];
        $this->steps = $recipe['steps'];
        $this->time = $recipe['time'];
        $this->likes = $recipe['likes'];
        $this->views = $recipe['views'];
        $this->recipeArr = $recipe;
    }

    public function cloneFrom($oldRecipe)
    {
        return new Recipe($oldRecipe->recipeArr);
    }

    public function renderRecipeCard() {
        echo "
<div class='col'>
    <div class='card' style='width: 18rem;'>
        <form method='post' action='/Lb/views/recipe-page.php'>
            <div style='height: 250px'>
                <img src='/Lb/images/$this->photo' class='card-img-top' alt='$this->title' style='object-fit: cover; width: 100%; height: 100%'>
            </div>
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
<main>
    <div class='recipe-container'>
        <div class='recipe-page-title'><h1>$this->title</h1></div>    
        <div class='recipe-top'>
            <div style='flex-basis: 50%; margin-right: 15px; max-height: 400px'>
                <img src='/Lb/images/$this->photo' class='recipe-main-photo' alt='$this->title'>
            </div>
            <div class='recipe-ingredients-container'>
                <div style='display: flex; flex-direction: column; padding: 20px; height: 100%'>
                    <h3>Ingredients</h3>
                    <div>
                        <ul class='ingredients-list'>";

                    for ($i = 0; $i < count($this->ingredients); $i++) {
                        echo "
                            <li style='display: flex; justify-content: space-between; margin: 5px 0 5px 0'>
                                <div>".$this->ingredients[$i]['name'].":</div>
                                <div>".$this->ingredients[$i]['quantity']." ".$this->ingredients[$i]['m_unit']."</div>
                            </li>
                        ";
                    }

                echo "</ul>
                    </div>
                    <div style='display: flex; align-items: flex-end; flex-grow: 1'>$this->description</div>
                    <div style='display: flex; justify-content: space-between; margin: 15px 0 5px 0'>
                        <div><img src='/Lb/images/view.png' alt='Views' width='20px'> $this->views</div>
                        <div><img src='/Lb/images/like.png' alt='Likes' width='20px'> $this->likes</div>
                    </div>
                </div>
            </div>
        </div><br>
        <div><h3>Steps of cooking:</h3></div>
        <div><h5>Cooking time: $this->time</h5></div>
        <div class='row row-cols-2 g-3 justify-content-center'>";

            for ($i = 0; $i < count($this->steps); $i++) {
                $this->renderRecipeStep($i);
            }

            echo "    
        </div>        
    </div>
</main>
";
    }

    public function renderRecipeStep($num) {
        $stepNum = $num + 1;

            echo "
<div class='col d-flex flex-column align-items-center justify-content-end' style='max-height: 300px; margin-top: 40px'>
    <img src='/Lb/images/".$this->steps[$num]['photo']."' class='recipe-step-photo' alt=''>
    <div>
    <b>$stepNum. </b>
    ".$this->steps[$num]['description']."
    </div>
</div>";
    }
}






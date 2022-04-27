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

    public function __construct($id, $title, $photo, $description, $steps, $time, $likes, $views) {
        $this->id = $id;
        $this->title = $title;
        $this->photo = $photo;
        $this->description = $description;
        $this->steps = $steps;
        $this->time = $time;
        $this->likes = $likes;
        $this->views = $views;
    }

    public function renderRecipeCard() {
        echo "
<div class='col'>
    <div class='card' style='width: 18rem;'>
        <form method='post'>
            <img src='$this->photo' class='card-img-top' alt='$this->title'>
            <input type='hidden' name='currentRecipe' value='$this->id'>
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

    public function renderOpenedRecipe() {
        echo "
        
";
    }
}

?>



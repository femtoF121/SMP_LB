<?php
require_once 'MainPage.php';

class RecipePage extends MainPage
{
    private array $currentRecipe;
    
    public function __construct($isAuthorized, $currentUser, $currentRecipe)
    {
        parent::__construct($isAuthorized, $currentUser);

        $this->currentRecipe = $currentRecipe;
    }
    
    public function getContent()
    {
        $recipe = new Recipe($this->currentRecipe);
        $recipe->renderOpenedRecipe();
    }
}
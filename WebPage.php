<?php

class WebPage
{
    protected $isAuthorized = true;

    public function __construct($isAuthorized)
    {
        $this->isAuthorized = $isAuthorized;
    }

    function loadStyles()
    {
        include 'components/head.php';
    }

    function getHeader($currentUser) {
        if($this->isAuthorized) {//currentUser -> profile
            include 'components/authorizedHeader.php';
        }
        else {
            include 'components/header.php';
        }
    }

    function getFooter() {
        include 'components/footer.php';
    }
//    private $recipes = [];
//    public function __construct($recipes)
//    {
//        $this->recipes = $recipes;
//    }
//
//    function getHeader()
//    {
//        include 'components/authorizedHeader.php';
//    }
//
//    function getFooter()
//    {
//        include 'components/footer.php';
//    }
//
//    function renderRecipes() {
//        foreach ($this->recipes as $recipe) {
//            echo "<div></div>";
//        }
//    }

}

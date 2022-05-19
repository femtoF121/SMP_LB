<?php
require_once "WebPage.php";
require_once "Recipe.php";
require_once "visit_counter.php";

class MainPage extends WebPage
{
    private $currentUser;
    private array $recipes = [];
    private int $globalVisitsCount;
    private $statCurrentUser;

    public function __construct($isAuthorized, $currentUser = null)
    {
        parent::__construct($isAuthorized);

        globalVisits();
        $file = 'logs.txt';
        $globalVisitsFile = file($file);
        $this->globalVisitsCount = count($globalVisitsFile);

        $stat = userVisitsCounter();
        $this->statCurrentUser = $stat['currentUser']['count'];

        $this->currentUser = $currentUser;

        if(!empty($_SESSION['recipes'])) {
            foreach ($_SESSION['recipes'] as $item) {
                $this->recipes[] = new Recipe($item);
            }
        }
    }

    function getContent()
    {
        echo "
        <main>
            <div class='container container-fluid'>
                <div class='row mb-4 justify-content-end'>
                    <div class='statBlock'>
                        <p>Global visits: <strong>$this->globalVisitsCount</strong></p>
                        <p>Your visits today: <strong>$this->statCurrentUser</strong></p>
                    </div>
                </div>
                <div class='row row-cols-4 g-3'>
        ";

        foreach ($this->recipes as $oneRecipe) {
            $oneRecipe->renderRecipeCard();
        }

        echo "
                </div>
            </div>
        </main>        
        ";
    }

    function loadPage()
    {
        echo "<!doctype html>
<html lang=\"en\">";
        $this->loadStyles();
        echo "<body>";
        $this->getHeader($this->currentUser);
        $this->getContent();
        $this->getFooter();
        echo "</body></html>";
    }
}

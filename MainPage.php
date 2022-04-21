<?php
require_once "WebPage.php";

class MainPage extends WebPage
{
    private $currentUser;

    public function __construct($isAuthorized, $currentUser = null)
    {
        parent::__construct($isAuthorized);
        $this->currentUser = $currentUser;
    }

    function getContent()
    {
        include 'components/main.php';
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

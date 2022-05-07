<?php
require_once 'MainPage.php';

class AddingRecipePage extends MainPage
{
    public function __construct($isAuthorized, $currentUser = null)
    {
        parent::__construct($isAuthorized, $currentUser);
    }

    public function getContent()
    {
        echo "
<main>
    <div class='adding-recipe-main-container'>
        <div style='display: flex;'>
            <div class='adding-recipe-photo-container'>
                <img src='images/attachment.png' alt='Attach your photo here'>
                <h3>Add photo</h3>
            </div>
            <div style='flex-basis: 50%; display: flex; flex-direction: column; margin: 7vh;'>
                <input placeholder='Recipe title...' class='adding-recipe-input' style='margin-bottom: 20px; flex-basis: 20%;'>
                <textarea placeholder='Recipe description...' class='adding-recipe-input' style='flex-basis: 80%'></textarea>
            </div>
        </div> 
        <div></div>
        <div></div>   
    </div>
</main>
        ";
    }
}
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
            <div class='input__wrapper'>
               <input name='file' type='file' name='file' id='input__file' class='input input__file' multiple>
               <label for='input__file' class='input__file-button'>
                  <span class='input__file-icon-wrapper' style='font-size: 50px'>+</span>
                  <span class='input__file-button-text'>Выберите файл</span>
               </label>
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
        echo "
<script>
    let inputs = document.querySelectorAll('.input__file');
    Array.prototype.forEach.call(inputs, function (input) {
      let label = input.nextElementSibling,
        labelVal = label.querySelector('.input__file-button-text').innerText;
  
      input.addEventListener('change', function (e) {
        let countFiles = '';
        if (this.files && this.files.length >= 1)
          countFiles = this.files.length;
  
        if (countFiles)
          label.querySelector('.input__file-button-text').innerText = 'Выбрано файлов: ' + countFiles;
        else
          label.querySelector('.input__file-button-text').innerText = labelVal;
      });
    });
</script>
";
    }
}
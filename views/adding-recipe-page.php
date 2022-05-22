<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/WebPage.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/RecipesModel.php';

session_start();
if (!isset($_SESSION['currentUser'])) {
    header("Location: ../views/authLayout.php");
    die();
}

$page = new WebPage($_SESSION['currentUser']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CookDise</title>
    <link rel='icon' href='/Lb/title-icon.png'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link rel='stylesheet' href='../styles.css'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&family=Montserrat:wght@400;700&display=swap'
          rel='stylesheet'>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'
            integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p'
            crossorigin='anonymous'></script>
    <script defer src='../js/adding-recipe-page.js'></script>
</head>
<body>
<?php $page->getHeader($_SESSION['currentUser']); ?>
<main class="main">
    <form class="form addRecipe__form" method="post" action="/Lb/controllers/addRecipe.php">
        <div style="display:flex; align-items: center; justify-content: center; gap: 25px">
            <div>
                <div class="recipeImageContainer">
                    <img class="preview" src='/Lb/images/placeholder-recipe.jpg' alt='step' style="object-fit: cover">
                </div>
                <label for="uploadTitle" class="uploadLabel" style="user-select: none">Upload image</label>
                <input name="recipeImage" class="recipeImageInput" id="uploadTitle" type="file" accept="image/*" hidden>
            </div>
            <div>
                <label for="time" class="form-label">Time of cooking</label>
                <input name="time" id="time" class="form-control" placeholder="1h">
            </div>
        </div>
        <div>
            <label for="title" class="form-label">Title of dish</label>
            <input name="title" id="title" class="form-control" placeholder="Soup">
        </div>
        <div>
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="So delicious"></textarea>
        </div>
        <div>
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea name="ingredients" id="ingredients" class="form-control" placeholder="Water: 1l" rows="5"></textarea>
        </div>
        <label for="steps" class="form-label">Steps</label>
        <ul id="stepsList">
            <li id="step1" class="step d-flex align-items-center" style="margin-bottom: 15px;">
                <div style="margin-right: 10px">
                    <div class="stepImageContainer">
                        <img class="preview" src='/Lb/images/placeholder-step.jpg' alt='step' style="object-fit: cover">
                    </div>
                    <label for="uploadStepImage" class="uploadLabel">Upload image</label>
                    <input name="stepImage" class="stepImageInput" id="uploadStepImage" type="file" accept="image/*" hidden>
                </div>
                <textarea name="steps[]" id="steps" class="form-control" placeholder="Wash your hands" rows="2"
                          style="margin-right: 10px"></textarea>
            </li>
        </ul>
        <button id="addStepBtn" type="button" class="btn btn-success" style="width: 100px; margin: 0 auto;">Add step
        </button>
        <button class="btn btn-primary" type="submit" style="margin-top: 20px">Add recipe</button>
    </form>
</main>
<?php $page->getFooter(); ?>
</body>
</html>
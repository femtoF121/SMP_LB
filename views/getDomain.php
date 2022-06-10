<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/WebPage.php';
session_start();

$domain = "";
    if(!empty($_GET['url'])) {
        preg_match('/https?:\/\/([\w+\.?]+)\//', $_GET['url'], $matches);
        if(count($matches) != 0) $domain = $matches[1];
    }

    $page = new WebPage(true);
?>
<!doctype html>
<html lang="en">
<?php $page->loadStyles(); ?>
<body>
<?php $page->getHeader($_SESSION['currentUser']); ?>
<div class="domain__container">
    <div class="forms__card">
        <form class="form">
            <h2 style="margin: 15px auto;">Get domain</h2>
            <label class="form-label">
                URL
                <input name="url" type="text" placeholder="https://..." class="form-control" value="<?php echo $_GET['url'] ?>">
            </label>
            <button type="submit" class="btn btn-success" style="margin-top:10px;background-color: #66B54E; border-color: #66B54E;">Get domain</button>
        </form>
        <?php if(!empty($_GET['url'])) { ?>
        <h2 style="color: purple; text-align: center">Domain: <?php echo htmlentities($domain) ?></h2>
        <?php }?>
    </div>
</div>
</body>
</html>

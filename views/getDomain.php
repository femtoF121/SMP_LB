<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/WebPage.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/LogsAndBrowserInfo.php';
session_start();

function ChangeBadWords($str) :void
{
    if(strlen($str) == 0) return;
    preg_match_all('/\w?[дД]+\s?[уУyY]+\s?[рРpP]+\s?[еЕeE]+\s?[нНH]+\s?[ьЬ]+/',$str, $matches);
    //print_r($matches);
    foreach ($matches as $match) $str = str_replace($match, "хороша людина", $str);
    echo $str;
}

$domain = "";
    if(!empty($_GET['url'])) {
        preg_match('/https?:\/\/([\w+\.?]+)\//', $_GET['url'], $matches);
        if(count($matches) != 0) $domain = $matches[1];
    }

    $page = new WebPage(true);
    $lastLog = AnalyseLogs();
    $ua = GetBrowser();
    $userBrowser= ["Your browser: " . $ua['name'], "version: " . $ua['version'], "platform: ". $ua['platform'], " reports: " . $ua['userAgent']];
?>
<!doctype html>
<html lang="en">
<?php $page->loadStyles(); ?>
<body>
<?php $page->getHeader($_SESSION['currentUser']); ?>
<div class="domain__container" style="flex-wrap: wrap; gap: 20px;">
    <div style="display: flex; flex-direction: row-reverse; justify-content: space-evenly;">
        <div class="forms__card" style="height: 291px;  margin-left: 40px; width: 400px">
            <form class="form">
                <h2 style="margin: 15px auto;">Change bad words</h2>
                <label class="form-label">
                    Input/output text:
                    <textarea name="textToChange" class="form-control" rows="4" style="width: 100%"><?php if(isset($_GET['textToChange'])) ChangeBadWords($_GET['textToChange']); ?></textarea>
                    <button type="submit" class="btn btn-success" style="width: 100%; margin-top:20px;background-color: #66B54E; border-color: #66B54E;">Change "дурень" to "хороша людина"</button>
                </label>
            </form>
        </div>
        <div class="forms__card" style="width: 400px; height: 291px">
            <form class="form">
                <h2 style="margin: 15px auto;">Get domain</h2>
                <label class="form-label">
                    URL
                    <input name="url" type="text" placeholder="https://..." class="form-control" value="<?php if(isset($_GET['url'])) echo $_GET['url'] ?>">
                </label>
                <button type="submit" class="btn btn-success" style="margin-top:10px;background-color: #66B54E; border-color: #66B54E;">Get domain</button>
            </form>
            <?php if(!empty($_GET['url'])) { ?>
                <h2 style="color: purple; text-align: center">Domain: <?php echo htmlentities($domain) ?></h2>
            <?php }?>
        </div>
    </div>
    <div style="display: flex; flex-direction: row; justify-content: space-evenly;">
        <div class="forms__card" style="justify-content: space-evenly; margin-top: 20px; margin-right: 40px; min-height: 100px; padding: 20px 0; width: 400px">
            <h5 style="color: purple; text-align: center"><?php echo $lastLog[0] ?></h5>
            <hr>
            <h5 style="color: purple; text-align: center; overflow-wrap: break-word"><?php echo $lastLog[1] ?></h5>
            <hr>
            <h5 style="color: purple; text-align: center"><?php echo $lastLog[2] ?></h5>
        </div>
        <div class="forms__card" style="justify-content: space-evenly; margin-top: 20px; min-height: 100px; padding: 20px 0; width: 400px">
            <h4 style="color: green; text-align: center"><?php echo $userBrowser[0] ?></h4>
            <hr>
            <h4 style="color: green; text-align: center"><?php echo $userBrowser[1] ?></h4>
            <hr>
            <h4 style="color: green; text-align: center"><?php echo $userBrowser[2] ?></h4>
<!--            <p style="color: green; text-align: center">--><?php //echo $userBrowser[3] ?><!--</p>-->
        </div>
    </div>
</div>
</body>
</html>

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
        echo "
<head>
    <meta charset='UTF'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>CookDise</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link rel='stylesheet' href='styles.css'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&family=Montserrat:wght@400;700&display=swap' rel='stylesheet'>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
</head>        
";
    }

    function getHeader($currentUser) {
        $userPhoto = "images/" . $currentUser['photo'];
        if($this->isAuthorized) {
            echo "
<header>
    <nav class='navbar navbar-expand-lg'>
        <div class='container container-fluid'>
            <a class='logo mr-4' href='index.php'>
                <img class='logo' src='images/logo.svg' alt='logo'/>
            </a>
            <div class='collapse navbar-collapse'>
                <ul class='navbar-nav me-auto' style='margin-left: 50px'>
                    <li class='nav-item' style='margin-right: 20px'>
                        <button class='secondaryBtn'>Find recipe</button>
                    </li>
                    <li class='nav-item'>
                        <a href='adding-recipe-page.php'><button class='secondaryBtn'>Add recipe</button></a>
                    </li>
                </ul>
                <ul class='navbar-nav me-auto social-medias'>
                    <li class='nav-item'>
                        <a class='nav-link active' aria-current='page' href='#'>
                            <img src='images/telegram.svg' alt='telegram'>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>
                            <img src='images/facebook.svg' alt='facebook'>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>
                            <img src='images/instagram.svg' alt='instagram'>
                        </a>
                    </li>
                </ul>
                <button class='avatarBtn'>
                    <img class='avatar' src='$userPhoto' alt='photo'>
                </button>
            </div>
        </div>
    </nav>
</header>            
";
        }
        else {
            echo "
<header>
    <div class='container'>
        <div class='container-fluid'>
            <a href='#'>
                <img class='logo' src='images/logo.svg' alt='logo'/>
            </a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarColor02'
                    aria-controls='navbarColor02' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarColor02'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Find recipe</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link active' aria-current='page' href='#'>Sign Up</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Sign In</a>
                    </li>
                </ul>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                    <li class='nav-item'>
                        <a class='nav-link active' aria-current='page' href='#'>
                            <img src='images/telegram.svg' alt='telegram'>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>
                            <img src='images/facebook.svg' alt='facebook'>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>
                            <img src='images/instagram.svg' alt='instagram'>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>    
";
        }
    }

    function getFooter() {
        echo "
<footer>
    <div class='container-fluid container d-flex align-items-center justify-content-space-between'>
        <img src='images/logo.svg' alt='logo' class='logo'/>
        <div class='social-medias' style='margin-left: 100px'>
            <a href='#'>
                <img src='images/telegram.svg' alt='telegram'>
            </a>
            <a href='#'>
                <img src='images/facebook.svg' alt='facebook'>
            </a>
            <a href='#'>
                <img src='images/instagram.svg' alt='instagram'>
            </a>
        </div>
    </div>
</footer>        
";
    }

}

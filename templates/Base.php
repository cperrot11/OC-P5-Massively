<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
    </head>
    <body class="is-preload">
        <div id="wrapper" class="fade-in">
            <div id="content">
                <!-- Intro -->
                <div id="intro">
                    <h1>Christophe <br />PERROTIN</h1>
                    <p>La mise en place d'une application Web est subtil mélange de technique, <br />
                        de sensibilité et beaucoup de passion.</p>
                    <ul class="actions">
                        <li><a href="#header" class="button icon solo fa-arrow-down scrolly">Continue</a></li>
                    </ul>
                </div>
                <!-- Header -->
                <header id="header">
                    <a href="index.html" class="logo">Bienvenue</a>
                </header>
                <!-- Nav -->
                <?php require_once ($admin)?"AdminNavbar.php":"Navbar.php" ?>
<!--                <div id="main">-->
                    <?= $content ?>
<!--                </div>-->
            </div>
        </div>
        <!-- Scripts -->
        <script src="../public/js/jquery.js"></script>
        <script src="../assets/js/jquery.scrollex.min.js"></script>
        <script src="../assets/js/jquery.scrolly.min.js"></script>
        <script src="../assets/js/browser.min.js"></script>
        <script src="../assets/js/breakpoints.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>


        <script src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"> </script>
        <script src="../public/js/jquery.jrumble.1.3.min.js"></script>
        <script src="../public/js/myJs.js"></script>
    </body>
</html>
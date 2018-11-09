<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
</head>
<body>
<?php require_once ($admin)?"AdminNavbar.php":"Navbar.php" ?>
<div id="content">
    <?= $content ?>
</div>
<script src="../public/js/jquery.js"></script>
<script src="../public/js/jquery.jrumble.1.3.min.js"></script>
<script src="../public/js/myJs.js"></script>
</body>
</html>
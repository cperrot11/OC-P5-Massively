<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../public/css/bootstrap.css">
    <link rel="stylesheet" href="../public/css/mystyle.css">
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
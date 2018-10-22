<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
</head>
<body>
<?php require_once ($admin)?"admin_navbar.php":"navbar.php" ?>
<div id="content">
    <?= $content ?>
</div>
</body>
</html>
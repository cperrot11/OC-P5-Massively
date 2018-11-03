<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/bootstrap.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="../public/img/reglages.jpg" height="100"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../public/index.php">Site<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/index.php?route=admin_articles">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/index.php?route=gestion_commentaire">Commentaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/index.php?route=gestion_membres">Membres</a>
                </li>
            </ul>
            <div class="badge badge-pill badge-info">
                <a class="nav-link" href="index.php?route=login">
                    <?= isset($_SESSION['role']) ? 'Membre = '.$_SESSION['login']:'Connexion' ?>
                </a>
            </div>
        </div>
    </nav>
</body>
</html>
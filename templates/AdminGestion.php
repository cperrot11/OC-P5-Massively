<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 20/10/2018
 * Time: 20:28
 */
$this->title = "Gestion";
?>
<head>
    <link rel="stylesheet" href="../public/css/bootstrap.css">
    <link rel="stylesheet" href="../public/css/mystyle.css">
    <!--todo:personnaliser une classe pour le "a"-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="jumbotron-fluid">
                <h1 id="test" >Administration du blog</h1>
                <hr class="my-4">
                <span class="subheading">Accéder à la gestion des articles, des commentaires et des membres</span>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="card text-white bg-primary mb-3 mb-offset-1" style="max-width: 20rem;">
                <a class="text-white" href="../public/index.php?route=adminArticles">
                    <div class="card-header text-center">Articles</div>
                    <div class="card-body">
                        <h4 class="card-title">Gestion des articles</h4>
                        <p class="card-text">Cliquez içi pour ajouter, modifier ou supprimer des articles.</p>
                    </div>
                </a>
            </div>
            <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
                <a class="text-white" href="../public/index.php?route=adminCommentaires">
                    <div class="card-header  text-center">Commentaires</div>
                    <div class="card-body">
                        <h4 class="card-title">Approbation et gestion des commentaires</h4>
                        <p class="card-text">Cliquez içi pour valider les commentaires en attente.</p>
                    </div>
                </a>
            </div>
            <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
                <a class="text-white" href="../public/index.php?route=adminUsers">
                    <div class="card-header  text-center">Membres</div>
                    <div class="card-body">
                        <h4 class="card-title">Gestions de membres</h4>
                        <p class="card-text">Cliquez içi pour ajouter, modifier ou supprimer des membres..</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

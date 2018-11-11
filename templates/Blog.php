<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
$this->title = "Accueil";
?>
<head>
    <link rel="stylesheet" href="../public/css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Mon blog !</h1>
            <hr class="my-4">
            <span class="subheading">Des articles sur les sujets passionnants</span>
        </div>
    </div>
    <div class="row">
        <?php
        if(isset($_SESSION['error'])) {?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php echo '<p>'.$_SESSION['error'].'</p>';?> </strong>
            </div>
            <?php
            unset($_SESSION['error']);
        }
        ?>
    </div>
</div>
<div class="container">
    <div class="row">
        <br/>
        <a class="btn btn-primary btn-lg" href="../public/index.php?route=addArticle">Ajouter un article</a>
    </div>
    <hr class="my-4">
    <div class="row">
        <?php
        if(isset($_SESSION['add_article'])) {?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Félicitation!</strong> <?php echo '<p>'.$_SESSION['add_article'].'</p>';?>
            </div>
            <?php
            unset($_SESSION['add_article']);
        }
        ?>
    </div>
    <div class="row">
        <?php
        foreach ($articles as $article)
        {
            ?>
            <div class="col-sm-6 col-md-4 col-lg-4 posts cpTremble">
                <div class="card border-dark mb-3" style="max-width: 20rem;">
                    <h2 class="card-header">>
                        <a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>">
                            <?= htmlspecialchars($article->getTitle());?>
                        </a>
                    </h2>
                    <div class="card-body">
                        <p class="card-text"><?= htmlspecialchars($article->getContent());?></p>
                        <p class="card-text"><?= htmlspecialchars($article->getAuthor());?></p>
                        <p class="card-text">Créé le : <?= htmlspecialchars($article->getDateAdded());?></p>
                    </div>
                </div>
            </div>
            <br>
            <?php
        }
        ?>

    </div>
</div>
</body>

<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Modifier article</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=updateArticle<?php
     echo "&idArt=".$_GET['idArt'];?>">
        <?php echo $formulaire;?>
        <input class="btn btn-outline-success" type="submit" value="Envoyer" id="submit" name="submit">
        <input class="btn btn-outline-danger" type="reset" value="Annuler">
    </form>
    <a href="../public/index.php?route=adminArticles">Retour à la gestion des articles</a>
</div>

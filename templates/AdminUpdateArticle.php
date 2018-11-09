<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Modifier article</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=updateArticle<?php
     echo "&idArt=".$_GET['idArt'];?>">
        <?php echo $formulaire;?>
        <input type="reset" value="Annuler">
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php?route=adminArticles">Retour à la gestion des articles</a>
</div>

<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Ajouter commentaire</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=addComment<?php
     echo "&idArt=".$_GET['idArt'];?>">
        <?= $formulaire;?>
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>

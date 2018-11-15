<div class="container" xmlns="http://www.w3.org/1999/html">
    <hr>
    <div>
        <h1 class="display-5">Ajouter votre commentaire</h1>
        <p class="subheading">Attention : Les commentaires saisies doivent être validé avant publication.</p>
    </div>
    <form method="post" action="../public/index.php?route=addComment<?php
     echo "&idArt=".$_GET['idArt'];?>">
        <?= $formulaire;?>
        <input class="btn btn-outline-success" type="submit" value="Envoyer" id="submit" name="submit">
        <input class="btn btn-outline-danger" type="reset" value="Annuler" id="reset" name="reset">
    </form>
</div>

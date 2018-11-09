<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Modification commentaire</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=updateComment<?php
     echo "&idArt=".$_GET['idArt']."&idComment=".$_GET['idComment']."&appel=".$_GET['appel'];?>">
        <?php echo $formulaire;?>
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>


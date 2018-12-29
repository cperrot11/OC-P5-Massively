<?php
$this->title = "Modifier commentaire";
?>
<div id="main">
    <section class="post">
        <h2>Modification commentaire</h2>
        <form method="post" action="../public/index.php?route=updateComment<?= "&idArt=".$_GET['idArt']."&idComment=".$_GET['idComment']."&appel=".$_GET['appel'];?>#begin">
            <?= $formulaire;?>
            <input class="button primary small" type="submit" value="Envoyer" id="submit" name="submit">
            <input class="button primary small" type="reset" value="Annuler" id="reset" name="reset">
        </form>
        <a href="../public/index.php#begin">Retour à l'accueil</a>
    </section>
</div>


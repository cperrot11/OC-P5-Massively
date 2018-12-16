<?php
$this->title = "Modifier commentaire";
?>
<div id="main">
    <section class="post">
        <h2>Modification commentaire</h2>
        <form method="post" action="../public/index.php?route=updateComment<?php
        echo "&idArt=".$_GET['idArt']."&idComment=".$_GET['idComment']."&appel=".$_GET['appel'];?>#begin">
            <?php echo $formulaire;?>
            <input <input class="btn btn-outline-success" type="submit" value="Envoyer" id="submit" name="submit">
        </form>
        <a href="../public/index.php#begin">Retour à l'accueil</a>
    </section>
</div>


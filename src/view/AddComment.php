<?php
    $this->title = "Ajouter commentaire";
?>
<div id="main">
    <section class="post">
        <h2>Ajouter un commentaire</h2>
        <p class="subheading">Attention : Les commentaires saisies doivent être validés avant publication.</p>

        <form method="post" action="../public/index.php?route=addComment<?php echo "&idArt=".$_GET['idArt'];?>#begin">
            <?= $formulaire;?>
            <input class="button primary small" type="submit" value="Envoyer" id="submit" name="submit">
            <input class="button primary small" type="reset" value="Annuler" id="reset" name="reset">
        </form>
    </section>
</div>


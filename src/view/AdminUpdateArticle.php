<?php
$this->title = "Admin articles";
?>
<div id="main">
    <section class="post">
        <h2>Modifier article</h2>

        <form method="post" action="index.php?route=updateArticle<?php
         echo "&idArt=".$_GET['idArt'];?>#begin" enctype="multipart/form-data">
            <?php echo $formulaire;?>
            <input class="button primary small" type="submit" value="Envoyer" id="submit" name="submit">
            <input class="button primary small" type="reset" value="Annuler">
        </form>
        <a href="index.php?route=adminArticles#begin">Retour à la gestion des articles</a>
    </section>
</div>

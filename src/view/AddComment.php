<?php
    $this->title = "Ajouter commentaire";
?>
<div id="main">
    <section class="post">
        <h2>Ajouter un commentaire</h2>
        <p class="subheading">Attention : Les commentaires saisies doivent être validés avant publication.</p>

        <form method="post" action="index.php?route=addComment<?php echo "&idArt=".$_GET['idArt'];?>#begin">
            <?php
            if(isset($_SESSION['error'])) {?>
                <div class="cpAlert">
                    <?php echo '<p>'.$this->request->get('session', 'error').'</p>';?>
                    <i class="cpClose button icon solo fa-bomb scrolly"></i>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <?= $formulaire;?>
            <input class="button primary small" type="submit" value="Envoyer" id="submit" name="submit">
            <input class="button primary small" type="reset" value="Annuler" id="reset" name="reset">
        </form>
    </section>
</div>


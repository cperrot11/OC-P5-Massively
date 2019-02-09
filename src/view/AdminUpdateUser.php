<?php
$this->title = "Mise à jour utilisateurs";
?>
<div id="main">
    <section class="post">
        <h2>Modification utilisateur</h2>
        <form method="post" action="index.php?route=updateUser&appel=back#begin">
            <?php
            if(isset($_SESSION['error'])) {?>
                <div class="cpAlert">
                    <?php echo '<p>'.$_SESSION['error'].'</p>';?>
                    <i class="cpClose button icon solo fa-bomb scrolly"></i>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <?php echo $formulaire;?>
            <input class="button primary small" type="submit" value="Envoyer" id="submit" name="submit">
            <input class="button primary small" type="reset" value="Annuler" id="reset" name="reset">
        </form>
        <a href="index.php?route=adminUsers#begin">Retour à l'administration des utilisateurs</a>
    </section>
</div>

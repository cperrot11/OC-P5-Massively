<?php
$this->title = "Contact";
?>
<div id="main">
    <section class="post">
        <h2>CONTACTEZ-MOI</h2>
        <blockquote>Vos messages sont les bienvenus et je me ferais un plaisir d'y répondre.</blockquote>
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
        <form method="post" action="../public/index.php?route=contact#begin">
            <?= $formulaire;?>
            <input class="button primary small" type="submit" value="Envoyer" id="submit" name="submit">
            <input class="button primary small" type="reset" value="Annuler" id="reset" name="reset">
        </form>
    </section>
</div>

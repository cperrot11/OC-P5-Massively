
<?php
$this->title = "Accueil";
?>
<div id="main">
    <section class="post">
        <h2>Création utilisateur</h2>
        <span class="subheading">Saisir vos coordonnées et votre mot de passe qui sera crypté sur nos serveurs</span>
        <hr>

        <a class="btn btn-warning btn-sm" href="../public/index.php#begin">Retour à l'accueil</a>

        <hr>
        <form method="post" action="../public/index.php?route=addUser#begin">
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
            <input class="button primary small" type="submit" value="Valider" id="submit" name="submit">
            <input class="button primary small" type="submit" value="Annuler" id="logout" name="logout">
        </form>
    </section>
</div>

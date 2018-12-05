<div id="main">
    <section class="post">
    <h2>Connexion</h2>
            <?php if (isset($_SESSION['login']))
            {?>
                <span class="subheading">Vous êtes déjà connecté</span>
            <?php }
            else { ?>
                <span class="subheading">Saisir votre identifiant et votre mot de passe</span>
            <?php } ?>
            <div>
                <br/>
                <a class="button primary small" href="../public/index.php?route=addUser">Nouvel utilisateur</a>
                <a class="button primary small" href="../public/index.php">Retour à l'accueil</a>
            </div>
            <hr>

    <div class="row">
        <form method="post" action="../public/index.php?route=checkLogin">
                <?php if (isset($_SESSION['error']))
                {?>
                    <div class="alert alert-dismissible alert-success">
                        <?= $_SESSION['error']?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php }?>
                <?php echo $formulaire;?>
            <br/>
            <input class="button primary small" type="submit" value="Connecter" id="submit" name="submit">
            <a class="button primary small" href="../public/index.php?route=logout">Déconnecter</a>
        </form>
    </div>
    </section>
</div>


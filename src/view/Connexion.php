<div id="main">
    <section class="post">
    <h2>Connexion</h2>
            <?php if ($this->request->isloged())
            {?>
                <span class="subheading">Vous êtes déjà connecté</span>
            <?php }
            else { ?>
                <span class="subheading">
                    Saisir votre identifiant et votre mot de passe.<br/>
                    Vous devez vous inscrire, pour pouvoir participer au forum.
                </span>
            <?php } ?>
            <div>
                <br/>
                <a class="button" href="index.php?route=addUser&appel=front#begin">Nouvel utilisateur</a>
                <a class="button" href="index.php#begin">Retour à l'accueil</a>
            </div>
            <hr>

    <div class="row">
        <form method="post" action="index.php?route=checkLogin#begin">
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
            <br/>
            <input class="button primary small" type="submit" value="Connecter" id="submit" name="submit">
            <a class="button primary small" href="index.php?route=logout#begin">Déconnecter</a>
        </form>
    </div>
    </section>
</div>


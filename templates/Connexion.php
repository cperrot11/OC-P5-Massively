<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Connexion</h1>
            <?php if (isset($_SESSION['login']))
            {?>
                <span class="subheading">Vous êtes déjà connecté</span>
            <?php }
            else { ?>
                <span class="subheading">Saisir votre identifiant et votre mot de passe</span>
            <?php } ?>
            <hr class="my-4">
        </div>
    </div>
    <div class="row">
        <form method="post" action="../public/index.php?route=check">
                <?php if (isset($_SESSION['error']))
                {?>
                    <div class="alert alert-dismissible alert-success">
                        <?= $_SESSION['error']?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php }?>
                <?php echo $formulaire;?>
            <br/>
            <input class="btn btn-outline-success" type="submit" value="Connecter" id="submit" name="submit">
            <input class="btn btn-outline-danger" type="submit" value="Déconnecter" id="logout" name="logout">
        </form>
    </div>

        <p class="subheading">Pour créer un nouveau compte cliquez ci dessous.</p>
        <button class="btn btn-outline-warning"><a href="../public/index.php?route=newUser">Nouvel utilisateur</a></button>
    <div class="row">
        <a href="../public/index.php">Retour à l'accueil</a>
    </div>
</div>


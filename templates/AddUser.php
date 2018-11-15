<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Création utilisateur</h1>
            <span class="subheading">Saisir vos coordonnées et votre mot de passe qui sera crypté sur nos serveurs</span>
            <hr class="my-4">
        </div>
    </div>
    <div>
        <a class="btn btn-warning btn-sm" href="../public/index.php">Retour à l'accueil</a>
    </div>
    <hr class="my-4">
    <form method="post" action="../public/index.php?route=addUser">
        <div class="text-danger">
            <?= isset($_SESSION['error'])? $_SESSION['error']:"" ?>
        </div>
        <?php echo $formulaire;?>
        <input class="btn btn-outline-success" type="submit" value="Valider" id="submit" name="submit">
        <input class="btn btn-outline-danger" type="submit" value="Annuler" id="logout" name="logout">
    </form>
</div>

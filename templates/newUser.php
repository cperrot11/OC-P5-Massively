<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Connexion</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=check">
        <div class="text-danger">
            <?= isset($_SESSION['error'])? $_SESSION['error']:"" ?>
        </div>
        <?php echo $formulaire;?>
        <input type="submit" value="Envoyer" id="submit" name="submit">
        <input type="submit" value="Déconnecter" id="logout" name="logout">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>

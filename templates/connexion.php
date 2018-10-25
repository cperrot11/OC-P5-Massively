<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Connexion</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=check">
        <?php if (isset($_SESSION['error']))
        {?>
        <div class="alert alert-dismissible alert-success">
            <?= $_SESSION['error']?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php }
        ?>
        <div class="text-danger">

        </div>
        <?php echo $formulaire;?>
        <input type="submit" value="Déconnecter" id="logout" name="logout">
        <input type="submit" value="Envoyer" id="submit" name="submit">
        <input type="submit" value="Céer membre" id="submit" name="new">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>

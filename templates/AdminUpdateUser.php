<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Modification utilisateur</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=updateUser&appel=back">
        <div class="text-danger">
            <?= isset($_SESSION['error'])? $_SESSION['error']:"" ?>
        </div>
        <?php echo $formulaire;?>
        <input type="submit" value="Envoyer" id="submit" name="submit">
        <input type="submit" value="Annuler" id="logout" name="logout">
    </form>
    <a href="../public/index.php">Retour à l'administration des utilisateurs</a>
</div>

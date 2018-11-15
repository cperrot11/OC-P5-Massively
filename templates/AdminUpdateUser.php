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
        <input class="btn btn-outline-success" type="submit" value="Envoyer" id="submit" name="submit">
        <input class="btn btn-outline-danger" type="reset" value="Annuler" id="reset" name="reset">
    </form>
    <a href="../public/index.php?route=adminUsers">Retour à l'administration des utilisateurs</a>
</div>

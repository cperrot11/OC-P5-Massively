<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3">Créer article</h1>
        </div>
    </div>
    <form method="post" action="../public/index.php?route=addArticle">
        <?php echo $formulaire;?>
        <button class="btn btn-outline-success" name="submit" type="submit" value="Céer">Créer</button>
        <input class="btn btn-outline-danger" type="reset" value="Annuler">
    </form>
    <a href="../public/index.php?route=adminGestion">Retour à l'administration du blog</a>
    <br/>
    <a href="../public/index.php">Retour à l'acceuil du blog</a>
</div>

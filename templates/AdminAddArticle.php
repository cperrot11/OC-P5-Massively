<div id="main">
    <section class="post">
        <h2>Créer article</h2>
        <div class="row gtr-uniform">
            <form method="post" action="../public/index.php?route=addArticle#begin" enctype="multipart/form-data">

                    <?php echo $formulaire;?>
                    <input class="button primary small" type="submit" name="submit" value="Créer"/>
                    <input class="button primary small" type="reset" value="Annuler"/>
            </form>
        </div>
        <div>
            <a class="button" href="../public/index.php?route=adminGestion#begin">Retour à l'administration du blog</a>
            <a class="button" href="../public/index.php">Retour à l'acceuil du blog</a>
        </div>
    </section>
</div>

<div class="container" xmlns="http://www.w3.org/1999/html">
    <hr>
    <div>
        <h1 class="display-5">CONTACTEZ-MOI</h1>
        <p class="subheading font-italic">Vos messages sont les bienvenus et je me ferais un plaisir d'y répondre.</p>
    </div>
    <div class="row">
        <?php
        if(isset($_SESSION['error'])) {?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php echo '<p>'.$_SESSION['error'].'</p>';?> </strong>
            </div>
            <?php
            unset($_SESSION['error']);
        }
        ?>
    </div>
    <form method="post" action="../public/index.php?route=contact">
        <?= $formulaire;?>
        <input class="btn btn-outline-success" type="submit" value="Envoyer" id="submit" name="submit">
        <input class="btn btn-outline-danger" type="reset" value="Annuler" id="reset" name="reset">
    </form>
</div>

<div>
    <form method="post" action="../public/index.php?route=updateComment2<?php
     echo "&idArt=".$_GET['idArt'];
     if (isset($_GET['idComment'])){echo "&idComment=".$_GET['idComment'];}
     ?>">
        <?php echo $formulaire;
        var_dump($data)?>
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>

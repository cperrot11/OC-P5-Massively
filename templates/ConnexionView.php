<h2>Connexion</h2>

<form action="../public/index.php?route=check" method="post">
  <label>Pseudo</label>
  <input type="text" name="login" /><br />

  <label>Mot de passe</label>
  <input type="password" name="password" /><br /><br />
  <input type="hidden" name="route" value="<?= $_GET['route'] ?>"></input>
  <input type="hidden" name="idArt" value="<?= $_GET['idArt'] ?>"></input>
  <input type="hidden" name="idComment" value="<?= $_GET['idComment'] ?>"></input>
  <input type="submit" name="submit" value="Envoyer" />
</form>
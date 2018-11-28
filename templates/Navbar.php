<!-- Nav -->
    <nav id="nav">
<!--        <a class="" href="#"><img src="../public/img/avatar.jpg" height="100"/></a>-->
        <ul class="links">
            <li class="active"><a href="index.php?route=accueil">Accueil</a></li>
            <li><a href="index.php">Blog</a></li>
            <li><a href="index.php?route=contact">Contact</a></li>
            <li><a href="index.php?route=adminGestion">Admin</a></li>
        </ul>
        <div class="">
            <a href="index.php?route=login">
                <?= isset($_SESSION['role']) ? 'Membre = '.$_SESSION['login']:'Connexion' ?>
            </a>
        </div>
        <ul class="icons">
            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
        </ul>
    </nav>

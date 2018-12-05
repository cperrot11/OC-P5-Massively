    <nav id="nav">
<!--        <a class="navbar-brand" href="#"><img src="../public/img/reglages.jpg" height="100"/></a>-->
        <ul class="links">
                <li class=<?= ($_GET['route']==='accueil')?"active":"" ?>><a href="../public/index.php">Site</a></li>
                <li class=<?= ($_GET['route']==='adminArticles')?"active":"" ?>><a href="../public/index.php?route=adminArticles">Articles</a></li>
                <li class=<?= ($_GET['route']==='adminCommentaires')?"active":"" ?>><a href="../public/index.php?route=adminCommentaires">Commentaires</a></li>
                <li class=<?= ($_GET['route']==='adminUsers')?"active":"" ?>><a href="../public/index.php?route=adminUsers">Membres</a></li>
                <li class=<?= ($_GET['route']==='adminGestion')?"active":"" ?>><a href="index.php?route=adminGestion">Admin</a></li>
        </ul>
        <div class="">
            <a href="index.php?route=login">
                <?= isset($_SESSION['role']) ? 'Membre = '.$_SESSION['login']:'Connexion' ?>
            </a>
        </div>
        <ul class="icons">
            <li><a href="http://www.viadeo.com/p/002viqljzd758sz" class="icon fa-viadeo"><span class="label">viadeo</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="https://www.linkedin.com/in/christophe-perrotin-34480/" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
            <li><a href="https://github.com/cperrot11/" class="icon fa-github"><span class="label">GitHub</span></a></li>
        </ul>
    </nav>


    <nav id="nav">
        <?php if (isset($_GET['route']) and $_GET['route']<>'')
            {$route=$_GET['route'];}
        else
            {$route="accueil";}
        ?>
        <ul class="links" id="begin">
                <li title="Retour à l'accueil du site" class=<?= ($_GET['route']==='accueil')?"active":"" ?>><a href="index.php?route=accueil#begin">Site</a></li>
                <li class=<?= stristr($_GET['route'],'Article')?"active":"" ?>><a href="index.php?route=adminArticles#begin">Articles</a></li>
                <li class=<?= stristr($_GET['route'],'comment')?"active":"" ?>><a href="index.php?route=adminCommentaires#begin">Commentaires</a></li>
                <li class=<?= stristr($_GET['route'],'User')?"active":"" ?>><a href="index.php?route=adminUsers#begin">Membres</a></li>
                <li class=<?= ($_GET['route']==='adminGestion')?"active":"" ?>><a href="index.php?route=adminGestion#begin">Admin</a></li>
        </ul>
        <div class="connexion">
            <a href="index.php?route=login">
                <?= isset($_SESSION['role']) ? 'Membre = '.$_SESSION['login']:'Connexion' ?>
            </a>
        </div>
        <ul class="icons">
            <li><a title="Viadeo" href="http://www.viadeo.com/p/002viqljzd758sz" class="icon fa-viadeo"><span class="label">viadeo</span></a></li>
            <li><a title="Facebook" href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a title="Linkedin" href="https://www.linkedin.com/in/christophe-perrotin-34480/" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
            <li><a title="Github" href="https://github.com/cperrot11/" class="icon fa-github"><span class="label">GitHub</span></a></li>
        </ul>
    </nav>

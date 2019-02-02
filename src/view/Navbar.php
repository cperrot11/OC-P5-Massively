
    <nav id="nav">
        <?php if (isset($_GET['route']) and $_GET['route']<>'')
                    {$route=$_GET['route'];}
                else
                    {$route="accueil";}
        ?>
        <ul class="links" id="begin">
            <li title="Accueil du site" class=<?= ($route==='accueil')?"active":"" ?>><a href="index.php?route=accueil#begin">Accueil</a></li>
            <li title="Accéder aux articles" class=<?= stristr($route,'Article')?"active":"" ?>><a href="index.php?route=articles#begin">Blog</a></li>
            <li title="Formulaire de contact" class=<?= ($route==='contact')?"active":"" ?>><a href="index.php?route=contact#begin">Contact</a></li>
            <li title="Accès à l'administration" class=<?= ($route==='adminGestion')?"active":"" ?>><a href="index.php?route=adminGestion#begin">Admin</a></li>
        </ul>
        <div class="connexion">
            <a title="Accès à la page de connexion" href="index.php?route=login#begin">
                <?= isset($_SESSION['role']) ? 'Membre = '.$_SESSION['login']:'Connexion' ?>
            </a>
        </div>
        <ul class="icons">
            <li><a title="Viadeo" href="http://www.viadeo.com/p/002viqljzd758sz" class="icon fa-viadeo" target="_blank"><span class="label">viadeo</span></a></li>
            <li><a title="Facebook" href="#" class="icon fa-facebook"><span class="label" target="_blank">Facebook</span></a></li>
            <li><a title="Linkedin" href="https://www.linkedin.com/in/christophe-perrotin-34480/" class="icon fa-linkedin" target="_blank"><span class="label">Linkedin</span></a></li>
            <li><a title="Github" href="https://github.com/cperrot11/" class="icon fa-github" target="_blank"><span class="label">GitHub</span></a></li>
        </ul>
    </nav>

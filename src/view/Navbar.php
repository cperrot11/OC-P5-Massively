
    <nav id="nav">
        <?php if (isset($_GET['route']) and $_GET['route']<>'')
                    {$route=$_GET['route'];}
                else
                    {$route="accueil";}
        ?>
        <ul class="links" id="begin">
            <li class=<?= ($route==='accueil')?"active":"" ?>><a href="index.php?route=accueil#begin">Accueil</a></li>
            <li class=<?= stristr($route,'Article')?"active":"" ?>><a href="index.php?route=articles#begin">Blog</a></li>
            <li class=<?= ($route==='contact')?"active":"" ?>><a href="index.php?route=contact#begin">Contact</a></li>
            <li class=<?= ($route==='adminGestion')?"active":"" ?>><a href="index.php?route=adminGestion#begin">Admin</a></li>
        </ul>
        <div class="">
            <a href="index.php?route=login#begin">
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

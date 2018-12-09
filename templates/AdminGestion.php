<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 20/10/2018
 * Time: 20:28
 */
$this->title = "Gestion";
?>
<div id="main">
    <section class="post">
        <h2>Administration du blog</h2>
        <span class="subheading">Accéder à la gestion des articles, des commentaires et des membres</span>
        <hr>
        <div class="ligne">
            <div class="boite">
                    <a href="../public/index.php?route=adminArticles#begin">
                        <h3 class="header">Articles</h3>
                        <div>
                            <H1 class="icon fa-newspaper-o"></H1>
                            <footer>Cliquez içi pour ajouter, modifier ou supprimer des articles.</footer>
                        </div>
                    </a>
            </div>
            <div class="boite">
                    <a href="../public/index.php?route=adminCommentaires#begin">
                        <h3 class="header">Commentaires</h3>
                        <div>
                            <H1 class="icon fa-comments"></H1>
                            <footer>Cliquez içi pour valider les commentaires en attente.</footer>
                        </div>
                    </a>
            </div>
            <div class="boite">
                    <a href="../public/index.php?route=adminUsers#begin">
                        <h3 class="header">Membres</h3>
                        <div>
                            <H1 class="icon fa-user-plus"></H1>
                            <footer>Cliquez içi pour ajouter, modifier ou supprimer des membres..</footer>
                        </div>
                    </a>
            </div>
        </div>
    </section>
</div>
<?php
    $this->title = "Gestion des articles";
?>
<div id="main">
    <section class="post">
           <h2>Gestion des articles</h2>
           <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
           <span class="subheading">Vous pouvez modifier le contenu d'un article ou le supprimer.</span>
           <br/>
           <a class="button primary small" href="../public/index.php?route=addArticle#begin">Ajouter un article</a>
           <a class="button primary small" href="../public/index.php?route=adminGestion#begin">Retour à l'administration du blog</a>
           <hr>
        <div class="row">
            <?php
            if(isset($_SESSION['error'])) {?>
                <div class="cpAlert">
                    <?php echo '<p>'.$_SESSION['error'].'</p>';?>
                    <i class="cpClose button icon solo fa-bomb scrolly"></i>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <table class="alt">
                <thead>
                <tr>
                    <th scope="col">Num</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($articles as $article)
                    {
                        ?>
                            <tr class="table-light">
                                <td scope="row"><?= htmlspecialchars($article->getId());?></td>
                                <td><?= htmlspecialchars($article->getTitle());?></td>
                                <td><?= htmlspecialchars($article->getAuthor());?></td>
                                <td><?= htmlspecialchars($article->getDateAdded());?></td>
                                <td><a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin">Lire</a></td>
                                <td><a href="../public/index.php?route=updateArticle&idArt=<?= htmlspecialchars($article->getId());?>#begin">Modifier</a></td>
                                <td><a href="../public/index.php?route=deleteArticle&idArt=<?= htmlspecialchars($article->getId());?>#begin">Supprimer</a> </td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </section>>

</div>>
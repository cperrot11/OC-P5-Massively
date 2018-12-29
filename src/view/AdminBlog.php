<?php
    $this->title = "Gestion des articles";
?>
<div id="main">
    <section class="post">
           <h2>Gestion des articles</h2>
           <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
           <span class="subheading">Vous pouvez modifier le contenu d'un article ou le supprimer.</span>
           <br/>
           <a class="button" href="../public/index.php?route=addArticle#begin">Ajouter un article</a>
           <a class="button" href="../public/index.php?route=adminGestion#begin">Retour à l'administration du blog</a>
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
                                <td><a title="Lire" href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin"><?= htmlspecialchars($article->getTitle());?></a></td>
                                <td><?= htmlspecialchars($article->getAuthor());?></td>
                                <td class="no-wrap"><?= htmlspecialchars($article->getDateAdded());?></td>
                                <td><a title="Lire" class="icon fa-book" href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin"></a></td>
                                <td><a title="Modifier" class="icon fa-edit" href="../public/index.php?route=updateArticle&idArt=<?= htmlspecialchars($article->getId());?>#begin"></a></td>
                                <td>
                                    <form id="deleteform<?= $article->getId();?>" method="post" action="../public/index.php?route=deleteArticle&idArt=<?= $article->getId();?>">
                                        <a class="icon fa-trash delete" title="Supprimer" type="submit"/>
                                    </form>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
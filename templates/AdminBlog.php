<?php
    $this->title = "Admin articles";
?>
<div id="main">
    <section class="post">
                <h2>Gestion des articles</h2>
                <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
                <span class="subheading">Vous pouvez modifier le contenu d'un article ou le supprimer.</span>
            <br/>
            <a class="button primary small" href="../public/index.php?route=addArticle">Ajouter un article</a>
            <a class="button primary small" href="../public/index.php?route=adminGestion">Retour à l'administration du blog</a>

        <hr>
        <div class="row">
            <?php
            if(isset($_SESSION['error'])) {?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo '<p>'.$_SESSION['error'].'</p>';?> </strong>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <table class="table table-hover">
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
                                <td><a href="../public/index.php?route=updateArticle&idArt=<?= htmlspecialchars($article->getId());?>">Modifier</a></td>
                                <td><a href="../public/index.php?route=deleteArticle&idArt=<?= htmlspecialchars($article->getId());?>">Supprimer</a> </td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </section>>

</div>>
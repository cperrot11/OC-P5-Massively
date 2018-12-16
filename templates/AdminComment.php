<?php
$this->title = "Gestion commentaire";
?>
<div id="main">
    <section class="post">
        <h2>Gestion des commentaires</h2>
        <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
        <span class="subheading">Vous pouvez valider/dévalider un commentaire, le modifier ou supprimer.</span>
        <br/>
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
                    <th scope="col">Auteur</th>
                    <th scope="col">Contenu</th>
                    <th scope="col">Date</th>
                    <th scope="col">N° Article</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($comments as $comment)
                    {
                        ?>
                            <tr class="table-light">
                                <td scope="row"><?= htmlspecialchars($comment->getId());?></td>
                                <td><?= htmlspecialchars($comment->getPseudo());?></td>
                                <td><?= htmlspecialchars($comment->getContent(80));?></td>
                                <td class="no-wrap"><?= htmlspecialchars($comment->getDateAdded());?></td>
                                <td><?= htmlspecialchars($comment->getArticleId());?></td>
                                <td><a title="Valider O/N" class=<?= ($comment->getValide()==="1")?'"icon fa-check-square"':'"icon fa-square"'?>
                                       href="../public/index.php?route=valideComment&idComment=<?= htmlspecialchars($comment->getId());?>&valide=<?= htmlspecialchars($comment->getValide());?>#begin">
                                    </a>
                                </td>
                                <td><a title="Modifier" class="icon fa-edit" href="../public/index.php?route=updateComment&idArt=<?= htmlspecialchars($comment->getArticleId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=back#begin"></a></td>
                                <td><a title="Supprimer" class="icon fa-trash" href="../public/index.php?route=deleteComment&idComment=<?= htmlspecialchars($comment->getId());?>&appel=back#begin" onclick="return confirm('Confirmer suppression ?')"></a> </td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </section>>
</div>


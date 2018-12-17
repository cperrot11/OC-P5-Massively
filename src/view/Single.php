<?php
$this->title = "Article";
?>
<div id="main">
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
    <article class="post featured">
        <header class="major">
            <span class="date">Créé le : <?= htmlspecialchars($article->getDateAdded());?></span>
            <h2> <?= htmlspecialchars($article->getTitle());?> </h2>
        </header>
        <div class="image main"><img src=<?= "../uploads/".htmlspecialchars($article->getPicture());?> alt="" /></div>
        <p><?= htmlspecialchars($article->getContent());?></p>

        <p>Auteur : <span class="auteur"><?= htmlspecialchars($article->getAuthor());?></span></p>
        <a class="button" href="../public/index.php?route=articles#begin">Retour à la liste des articles</a>
    </article>
    <div id="comments" class="text-left" style="margin-left: 50px">
                <h3><?php if (count($comments)>0)
                {
                  echo count($comments)." Commentaires";
                }
                else
                    {
                        echo "Pas de commentaire pour l'instant, soignez le premier.";
                     } ?>
                </h3>

                <?php
                foreach ($comments as $comment)
                {?>
                    <div class="comment">
                            <div class="header">
                                <span> Auteur : <?= htmlspecialchars($comment->getPseudo());?></span>
                                <span> Posté le : <?= htmlspecialchars($comment->getDateAdded());?></span>
                            </div>
                            <p><?= htmlspecialchars($comment->getContent());?></p>
                            <?php if(isset($_SESSION['role']) && $_SESSION['role']==="admin")
                            { ?>
                                <footer>
                                    <a title="Modifier" class="icon fa-edit" href="../public/index.php?route=updateComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=front#begin"> Modifier</a>
                                    <a title="Supprimer" class="icon fa-trash" href="../public/index.php?route=deleteComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=front#begin" onclick="return confirm('Confirmer suppression ?')"> Supprimer</a>
                                </footer>
                                <?php
                            } ?>
                    </div>
                    <?php
                } ?>
    </div>
</div>
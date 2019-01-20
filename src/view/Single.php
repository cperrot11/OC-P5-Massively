<?php
/**
 * Display single blog
 *
 * PHP version 7.2
 *
 * @category Single
 * @package App\src\view
 * @author Christophe PERROTIN
 * @copyright 2018
 * @license MIT License
 * @link http://wwww.perrotin.eu
 */

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
            <span class="date">Modifié le : <?= htmlspecialchars($article->getDateAdded());?></span>
            <h2> <?= htmlspecialchars($article->getTitle());?> </h2>
            <blockquote> <?= htmlspecialchars($article->getChapo());?></blockquote>
        </header>

        <div class="image main"><img src=<?= "../uploads/".htmlspecialchars($article->getPicture());?> alt="" /></div>
        <p><?= htmlspecialchars($article->getContent());?></p>

        <p>Auteur : <span class="auteur"><?= htmlspecialchars($article->getAuthor());?></span></p>
        <a class="button" href="../public/index.php?route=articles#begin">Retour à la liste des articles</a>
    </article>
    <div id="comments" class="text-left" style="margin-left: 50px">
                <h3><?php switch (count($comments))
                {
                  case (1) :
                      echo count($comments)." Commentaire";
                      break;
                  case (0) :
                      echo "Pas de commentaire pour l'instant, soignez le premier.";
                      break;
                  default :
                      echo count($comments)." Commentaires";
                      break;
                }?>
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
                            <?php $path = "../public/index.php?route=deleteComment&appel=front&idComment=" ?>
                            <input type="hidden" id="path" value="<?php echo $path; ?>">
                            <?php if(isset($_SESSION['role']) && $_SESSION['role']==="admin")
                            { ?>
                                <footer>
                                    <a title="Modifier" class="icon fa-edit" href="../public/index.php?route=updateComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=front#begin"> Modifier</a>
                                    <a title="Supprimer" class="icon fa-trash validate" href="../public/index.php?route=deleteComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=front#begin"> Supprimer</a>
                                </footer>
                                <?php
                            } ?>
                    </div>
                    <?php
                } ?>
    </div>
</div>
<?php
$this->title = "Article";
?>
<div class="container">
    <div class="row justify-content-center jumbotron">
            <h1 class="display-3"><?= htmlspecialchars($article->getTitle());?></h1>
    </div>
    <div class="row justify-content-center jumbotron">
        <h3><?= htmlspecialchars($article->getContent());?></h3>
        <hr class="my-4">
        <div>
            <h3 class="col-6">Créé le : <?= htmlspecialchars($article->getDateAdded());?></h3>
            <h3 class="col-6">Auteur : <?= htmlspecialchars($article->getAuthor());?></h3>
        </div>
    </div>

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
    </div>
</div>
<div class="container">
    <div>
        <br/>
        <a class="btn btn-warning btn-sm" href="../public/index.php">Retour à la liste des articles</a>
    </div>
    <hr class="my-4">

    <div class="row">
        <div id="comments" class="text-left" style="margin-left: 50px">
            <h3><?php if (count($comments)>0)
            {
              echo count($comments)." Commentaires";
            }
            else {echo "Pas de commentaire pour l'instant, soignez le premier.";} ?></h3>

            <?php
            foreach ($comments as $comment)
            {
                ?>
                <div class="card border-danger mb-3" style="max-width: 20rem;">
                    <div class="card-header"><h4><?= htmlspecialchars($comment->getPseudo());?></h4></div>
                    <div class="card-body">
                        <h4 class="card-title"><p>Posté le <?= htmlspecialchars($comment->getDateAdded());?></p></h4>
                        <p class="card-text"><?= htmlspecialchars($comment->getContent());?></p>
                    </div>
                </div>
                <?php if(isset($_SESSION['role']) && $_SESSION['role']==="admin") { ?>
                    <a href="../public/index.php?route=updateComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=front">Modifier, </a>
                    <a href="../public/index.php?route=deleteComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=front">Supprimer, </a>
                <?php
                }
            }
            ?>
        </div>
        <?php  ?>
    </div>
</div>



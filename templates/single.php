<?php
$this->title = "Article";
?>
<div class="container">
    <div class="row">
        <div class="jumbotron-fluid">
            <h1 class="display-3"><?= htmlspecialchars($article->getTitle());?></h1>
        </div>
    </div>
    <div>
        <h2><?= htmlspecialchars($article->getContent());?></h2>
        <h3>Créé le : <?= htmlspecialchars($article->getDateAdded());?></h3>
    </div>
    <span class="subheading">Auteur : <?= htmlspecialchars($article->getAuthor());?></span>
</div>
<div class="container">
    <div class="row">
        <div id="comments" class="text-left" style="margin-left: 50px">
            <h3>Commentaires</h3>
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
                    <a href="../public/index.php?route=updateComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>">Modifier, </a>
                    <a href="../public/index.php?route=deleteComment&idArt=<?= htmlspecialchars($article->getId());?>&idComment=<?= htmlspecialchars($comment->getId());?>">Supprimer, </a>
                <?php
                }
            }
            ?>
            <a href="../public/index.php?route=addComment&idArt=<?= htmlspecialchars($article->getId());?>">Ajouter un commentaire</a>
        </div>
    </div>
</div>

<a href="../public/index.php">Retour à la liste des articles</a>


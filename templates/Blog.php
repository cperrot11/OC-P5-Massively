<?php
$this->title = "Blog";
?>
<div id="main">
    <section class="post">
        <h2>Mon blog !</h2>
        <blockquote>Des articles sur les sujets passionnants</blockquote>
            <?php
            if(isset($_SESSION['error'])) {?>
                <div class="">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo '<p>'.$_SESSION['error'].'</p>';?> </strong>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <a class="" href="../public/index.php?route=addArticle#begin">Ajouter un article</a>
            <?php
            if(isset($_SESSION['add_article'])) {?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Félicitation!</strong> <?php echo '<p>'.$_SESSION['add_article'].'</p>';?>
                </div>
                <?php
                unset($_SESSION['add_article']);
            }
            ?>
    </section>
    <section class="posts">
            <?php
            $cpt=0;
            foreach ($articles as $article)
            {
                $cpt++;
                ?>
                    <article>
                        <ul class="actions special">
                            <a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin">
                                    <?= htmlspecialchars($article->getTitle());?>
                            </a>
                        </ul>
                        <p>
                            <span class="image left"><img src=<?= "../uploads/".htmlspecialchars($article->getPicture());?> alt="" /></span>
                            <?= htmlspecialchars(substr($article->getContent(),0,200).'...');?></p>
                        <p class=""><?= htmlspecialchars($article->getAuthor());?></p>
                        <p class="date">Créé le : <?= htmlspecialchars($article->getDateAdded());?></p>
                        <ul class="actions special">
                            <li><a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin" class="button">Lire la suite</a></li>
                        </ul>
                    </article>
                <?php
            }
            ?>
    </section>
</div>
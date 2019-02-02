<?php
$this->title = "Blog";
?>
<div id="main">
    <section class="post">
        <h2>Bienvenue sur mon blog !</h2>
        <blockquote>
            <span>Ci dessous des articles sur des sujets passionnants.<br></span>
            <span>Vous êtes invité à participer et donner votre avis.<br></span>
            <span> Merci pour votre collaboration.</span>
        </blockquote>
        <?php
        if(isset($_SESSION['error'])) {?>
            <div class="cpAlert">
                <?php echo '<p>'.$this->request->get('session', 'error').'</p>';?>
                <i class="cpClose button icon solo fa-bomb scrolly"></i>
            </div>
            <?php
            $this->request->unsetSession('error');
        }
        ?>
            <a class="button" href="../public/index.php?route=addArticle#begin">Ajouter un article</a>
    </section>

            <?php
            $cpt=0;
            foreach ($articles as $article)
            {
                if ($cpt===0)
                {?>
                    <article id="first" class="post featured">
                        <header class="major">
                            <span class="date">Modifié le : <?= htmlspecialchars($article->getDateAdded());?></span>
                            <h2 class="actions special">
                                <a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin">
                                    <?= htmlspecialchars($article->getTitle());?>
                                </a>
                            </h2>
                            <blockquote><?= htmlspecialchars($article->getChapo(200))."...";?></blockquote>
                        </header>
                        <p>
                            <span class="image main"><img src=<?= "../uploads/".htmlspecialchars($article->getPicture());?> alt="" /></span>
                            <?= htmlspecialchars(substr($article->getContent(),0,200).'...');?></p>
                        <p>Auteur : <span class="auteur"><?= htmlspecialchars($article->getAuthor());?></span></p>
                        <ul class="actions special">
                            <li><a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin" class="button">Lire la suite</a></li>
                        </ul>
                    </article>
                    <section class="posts">
                    <?php $cpt++;
                }
                else
                {
                    ?>
                    <article class="cpTremble">
                        <header>
                            <a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin">
                                <?= htmlspecialchars($article->getTitle());?>
                            </a>
                        </header>
                        <p>
                            <span class="image left"><img src=<?= "../uploads/".htmlspecialchars($article->getPicture());?> alt="" /></span>
                            <?= htmlspecialchars($article->getChapo(250))."...";?>
                        </p>
                        <footer>
                            <div>
                                <p>Auteur : <span class="auteur"><?= htmlspecialchars($article->getAuthor());?></span></p>
                                <p class="date">Modifié le : <?= htmlspecialchars($article->getDateAdded());?></p>
                            </div>
                            <a href="../public/index.php?route=article&idArt=<?= htmlspecialchars($article->getId());?>#begin" class="button">Lire la suite</a>
                        </footer>
                    </article>
                    <?php
                }
            }
            ?>
    </section>
</div>
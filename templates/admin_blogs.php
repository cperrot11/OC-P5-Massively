<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
$this->title = "Accueil";
?>
<head>
    <link rel="stylesheet" href="../public/css/bootstrap.css">
</head>

<div class="container">
    <div class="row">
        <p class="alert-warning"><?= isset($_SESSION['error']) ? $_SESSION['error']:'' ?></p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Num</th>
                <th scope="col">Titre</th>
                <th scope="col">Auteur</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <?php
                foreach ($articles as $article)
                {
                    ?>
                        <tbody>
                        <tr class="table-light">
                            <th scope="row"><?= htmlspecialchars($article->getId());?></th>
                            <td><?= htmlspecialchars($article->getTitle());?></td>
                            <td><?= htmlspecialchars($article->getAuthor());?></td>
                            <td><?= htmlspecialchars($article->getDateAdded());?></td>
                            <td><a href="../public/index.php?route=updateArticle&idArt=<?= htmlspecialchars($article->getId());?>">Modifier</a></td>

                            <td><a href="../public/index.php?route=deleteArticle&idArt=<?= htmlspecialchars($article->getId());?>">Supprimer</a> </td>
                        </tr>
                        </tbody>

                    <?php
                }
                ?>
        </table>

    </div>
</div>
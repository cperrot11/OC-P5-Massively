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
    <link rel="stylesheet" href="../public/css/mystyle.css">
</head>
<body>
    <style>
        .focus {
            background-color: #DF691A !important;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }
        .selected {
            background-color: #DF691A !important;
            color: #fff;
            font-weight: bold;
        }
        .asc:after {content: "\25B2"; }
        .desc:after {content: "\25BC"; }
    </style>
    <div class="container">
        <div class="row">
            <div class="jumbotron-fluid">
                <h1 id="test" >Gestion des articles</h1>
                <hr class="my-4">
                <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
                <span class="subheading">Vous pouvez modifier le contenu d'un article ou le supprimer.</span>
            </div>
        </div>
        <br/>
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
    </div>

</body>
<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
$this->title = "Gestion commentaire";
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
        .table th{border-top: none;}
    </style>
    <div class="container">
        <div class="row">
            <div class="jumbotron-fluid">
                <h1 id="test" >Gestion des commentaires</h1>
                <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
                <span class="subheading">Vous pouvez valider/dévalider un commentaire, le modifier ou supprimer.</span>
            </div>
        </div>
        <div>
            <br/>
            <a class="btn btn-warning btn-sm" href="../public/index.php?route=adminGestion">Retour à l'administration du blog</a>
        </div>
        <hr class="my-4">
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
                    <th scope="col">Auteur</th>
                    <th scope="col">Contenu</th>
                    <th scope="col">Date</th>
                    <th scope="col">N° Article</th>
                    <th scope="col">Valide</th>
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
                                <td><?= htmlspecialchars($comment->getContent());?></td>
                                <td><?= htmlspecialchars($comment->getDateAdded());?></td>
                                <td><?= htmlspecialchars($comment->getArticleId());?></td>
                                <td><?= htmlspecialchars($comment->getValide());?></td>
                                <td><a href="../public/index.php?route=valideComment&idComment=<?= htmlspecialchars($comment->getId());?>&valide=<?= htmlspecialchars($comment->getValide());?>">Valider(O/N)</a></td>
                                <td><a href="../public/index.php?route=updateComment&idArt=<?= htmlspecialchars($comment->getArticleId());?>&idComment=<?= htmlspecialchars($comment->getId());?>&appel=back">Modifier</a></td>
                                <td><a href="../public/index.php?route=deleteComment&idComment=<?= htmlspecialchars($comment->getId());?>&appel=back">Supprimer</a> </td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</body>
<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
$this->title = "Gestion des membres";
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
                <h1 id="test" >Gestion des membres</h1>
                <hr class="my-4">
                <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
                <span class="subheading">Vous pouvez modifier ou supprimer un utilisateur.</span>
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
                    <th scope="col">Login</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Adresse e-mail</th>
                    <th scope="col">Admin</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($users as $user)
                    {
                        ?>
                            <tr class="table-light">
                                <td scope="row"><?= htmlspecialchars($user->getLogin());?></td>
                                <td><?= htmlspecialchars($user->getName());?></td>
                                <td><?= htmlspecialchars($user->getEmail());?></td>
                                <td><?= htmlspecialchars($user->getAdmin());?></td>
                                <td><a href="../public/index.php?route=updateUser&login=<?= htmlspecialchars($user->getLogin());?>&appel=back">Modifier</a></td>
                                <td><a href="../public/index.php?route=deleteUser&login=<?= htmlspecialchars($user->getLogin());?>">Supprimer</a> </td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
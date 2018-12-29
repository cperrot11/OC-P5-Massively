<?php
    $this->title = "Gestion des membres";
?>
<div id="main">
    <section class="post">
        <h2>Gestion des membres</h2>
        <span class="subheading">Trier le listing en cliquant sur le titre des colonnes.</span><br/>
        <span class="subheading">Vous pouvez modifier ou supprimer un utilisateur.</span>
        <br/>
        <a class="button" href="../public/index.php?route=addUser#begin">Nouvel utilisateur</a>
        <a class="button" href="../public/index.php?route=adminGestion#begin">Retour à l'administration du blog</a>
        <hr>
            <div class="row">
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
                <table class="alt">
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
                                    <td><a title="Modifier" class="icon fa-edit" href="../public/index.php?route=updateUser&login=<?= htmlspecialchars($user->getLogin());?>&appel=back#begin"></a></td>
                                    <td>
                                        <form id="deleteform<?= $user->getLogin();?>" method="post" action="../public/index.php?route=deleteUser&login=<?= htmlspecialchars($user->getLogin());?>">
                                            <a title="Supprimer" class="icon fa-trash delete" type="submit"/>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </section>
</div>
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
            <p class="alert-warning">
                <? if (isset($_SESSION['error']))
                    {
                        $_SESSION['error'];
                    }
                ?></p>
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
    <script src="../public/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('th').each(function(col) {
                $(this).hover(
                    function() { $(this).addClass('focus'); },
                    function() { $(this).removeClass('focus'); }
                );
                $(this).click(function() {
                    if ($(this).is('.asc')) {
                        $(this).removeClass('asc');
                        $(this).addClass('desc selected');
                        sortOrder = -1;
                    }
                    else {
                        $(this).addClass('asc selected');
                        $(this).removeClass('desc');
                        sortOrder = 1;
                    }
                    $(this).siblings().removeClass('asc selected');
                    $(this).siblings().removeClass('desc selected');
                    var arrData = $('table').find('tbody >tr:has(td)').get();
                    arrData.sort(function(a, b) {
                        var val1 = $(a).children('td').eq(col).text().toUpperCase();
                        var val2 = $(b).children('td').eq(col).text().toUpperCase();
                        if($.isNumeric(val1) && $.isNumeric(val2))
                            return sortOrder == 1 ? val1-val2 : val2-val1;
                        else
                            return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                    });
                    $.each(arrData, function(index, row) {
                        $('tbody').append(row);
                    });
                });
            });
        });
    </script>
</body>
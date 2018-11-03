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
    <script src="../public/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('th').click(function(){

                var table = $(this).parents('table').eq(0)
                var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
                this.asc = !this.asc
                if (!this.asc){
                    rows = rows.reverse();
                    $(this).removeClass('asc');
                    $(this).addClass('desc selected')
                }
                else
                {
                    $(this).removeClass('desc');
                    $(this).addClass('asc selected');
                }
                $(this).siblings().removeClass('asc selected');
                $(this).siblings().removeClass('desc selected');
                for (var i = 0; i < rows.length; i++){table.append(rows[i])}
            })
            function comparer(index) {
                return function(a, b) {
                    var valA = getCellValue(a, index), valB = getCellValue(b, index)
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
                }
            }
            function getCellValue(row, index){ return $(row).children('td').eq(index).text() }
        });
    </script>
</body>
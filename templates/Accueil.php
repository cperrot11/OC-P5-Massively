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
<body>
    <div class="container">
        <div class="row justify-content-center jumbotron">
            <h1 class="display-3 ">Christophe PERROTIN</h1>
            <span>La mise en place d'une application Web est subtil mélange de technique, de sensibilité et beaucoup de passion.</span>
        </div>
    </div>
    <div class="container jumbotron">
        <div class="row">
            <div class="col-lg-3 border-success">
                <img src="..\public\img\identité.jpg" width="100%">
            </div>
            <div class="col-lg-9 border-danger">
                <p>La société dans laquelle je travaille a besoin de développer des solutions Web autour de notre ERP (Microsoft Dynamics Nav), des dashboards BI, extranets pour nos clients et fournisseurs, etc...</p>
                <p>Pour le moment, nous faisons appel à des prestataires extérieurs, mais cela coute cher et laisse souvent un goût d'inachevé.J'ai réussi à convaincre ma direction que le cursus d'openclassrooms allait me permettre d'être productif rapidement.</p>
                <p>Depuis bientôt 1 an, je m'éclate en découvrant la programmation PHP-Symfony, cette formation trés complète permet de voir énormément de technologie et surtout de mettre en pratique à travers des projets concrets</p>
                <a class="btn btn-primary btn-sm" href="../public/cv.pdf" target="_blank">Télcharger mon CV</a>
                <a class="btn btn-primary btn-sm" href="../public/index.php">Visitez mon blog</a>
            </div>
        </div>
        <hr class="my-4">
        <div class="row justify-content-center">
            <h3>Me suivre</h3>
        </div>
        <div class="row justify-content-center">
                <ul class="list-unstyled custom-control-inline">
                    <li>
                        <a href="https://github.com/cperrot11/" target="_blank">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/christophe-perrotin-34480/" target="_blank">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.viadeo.com/p/002viqljzd758sz" target="_blank">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-viadeo fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                </ul>
        </div>
    </div>

</body>

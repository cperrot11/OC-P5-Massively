<!DOCTYPE html>
<?php session_start();
if(isset($_SESSION))
{
    $_SESSION = array();
    session_destroy();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceuil</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-md-center" style="background-color: #00FF99">
        <div class="jumbotron" style="border: #000d12 3px solid">
            <h1 class="display-3">Christophe PERROTIN !</h1>
            <p class="lead">Un développeur à votre écoute.</p>
            <hr class="my-4">
            <p>La mise en place d'une application Web est subtil mélange de technique, de sensibilité et beaucoup de passion.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="index.php" role="button">Visitez mon blog</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
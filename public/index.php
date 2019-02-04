<?php
if (!isset($_SESSION)) {
    session_start();
}
/* Constante def */
require '../config/ini.php';
/*autoload zone*/
require '../config/Autoloader.php';
\App\config\Autoloader::register();

/*autoload de composer*/
require '../vendor/autoload.php';

/*application laughter zone*/
$router = new \App\config\Router();
$router->run();

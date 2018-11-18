<?php
//partie autoload
require '../config/dev.php';
require '../config/Autoloader.php';
\App\config\Autoloader::register();

//autoload de composer
//require __DIR__ . '/vendor/autoload.php'
require '../vendor/autoload.php';

//require '../public/scratch/ex_home.php';
//partie lancement application
$router = new \App\config\Router();
$router->run();

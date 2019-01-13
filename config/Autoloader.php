<?php
/**
 * Use for autoload class without declaration
 *
 * PHP version 7.2
 *
 * @category Autoloader
 * @package config
 * @author Christophe PERROTIN
 * @copyright 2018
 * @license MIT License
 * @link http://wwww.perrotin.eu
 */
namespace App\config;

/**
 * Class Autoloader
 * @package App\config
 */
class Autoloader
{
    /**
     *
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * @param $class
     */
    public static function autoload($class)
    {
        $class = str_replace('App', '', $class);
        $class = str_replace('\\', '/', $class);
        require_once '../'.$class.'.php';
    }
}

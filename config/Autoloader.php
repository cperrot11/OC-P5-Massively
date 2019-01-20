<?php
/**
 * Use for autoload class without declaration
 *
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
     * Register 'autoload' as __autoload() implementation
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * @param $class class parameter
     */
    public static function autoload($class)
    {
        $class = str_replace('App', '', $class);
        $class = str_replace('\\', '/', $class);
        require_once '../'.$class.'.php';
    }
}

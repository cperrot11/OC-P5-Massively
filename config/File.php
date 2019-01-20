<?php
/**
 * Manage the files operations
 *
 * PHP version 7.2
 *
 *  @category File
 *  @package App\config
 *  @author Christophe PERROTIN
 *  @copyright 2018
 *  @license MIT License
 *  @link http://wwww.perrotin.eu
 */

namespace App\config;

use App\src\model\Article;

/**
 * Class File
 * @package App\config
 */
class File
{
    /**
     * @param $file
     * @param $article
     */
    public function addPicture($file, $article)
    {
        if (isset($file) && !empty($file['name'])) {
            $article->setPicture($file['name']);
            $article->setPicture_file($file['name']);
        }
    }

    /**
     * @param $file
     */
    public function movePicture($file)
    {
        if (isset($file) and !empty($file)) {
            $destination = 'C:/wamp64/www/OC/P5-Blog PHP/3-POO/App/uploads/';
            $destination.= basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $destination);
        }
    }

}
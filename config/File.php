<?php
/**
 * Manage the files operations
 *
 * PHP version 7.2
 *
 *  @category File
 *  @package App\config
 *  @author Christophe PERROTIN <christophe@perrotin.eu>
 *  @copyright 2018 c.perrotin *  @license MIT License
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
            $destination= PICTURE_REPO.basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $destination);
        }
    }

}
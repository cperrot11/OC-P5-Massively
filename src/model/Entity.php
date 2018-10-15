<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 14/10/2018
 * Time: 11:44
 */

namespace App\src\model;


abstract  class Entity
{
    public function isNew()
    {
        return empty($this->id);
    }

}
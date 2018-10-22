<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 23/08/2018
 * Time: 13:22
 */

namespace App\src\view;


class View
{
    private $file;
    private $title;
    private $admin;

    public function render($template, $data = [])
    {
        $this->admin = (substr($template,0,6)=="admin_")?true:false;
        $this->file = '../templates/'.$template.'.php';
        //1- Construit le template avec les valeurs
        $content  = $this->renderFile($this->file, $data);
        //2- Rajoute le masque général + titre
        $view = $this->renderFile('../templates/base.php', [
            'title' => $this->title,
            'admin' => $this->admin,
            'content' => $content
        ]);
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if(file_exists($file)){
            extract($data);
            //les données sont sous formes de tableau
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else {
            echo 'Fichier inexistant';
        }
    }
    public function setTitle($title){
            $this->title=$title;
    }
}
<?php
/**
 * Display 'Base' template with specific content
 *
 * @link http://wwww.perrotin.eu
 */

namespace App\src\view;


use App\config\Request;

class View
{
    private $file;
    private $title;
    private $admin;
    private $content;
    public $request;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->request = New Request();
    }

    /**
     * Construct the structure of the display final page
     *
     * @param $template
     * @param $display
     * @param array $data
     */
    public function render($template, $display, $data = [])
    {
        $this->admin = (substr($template,0,5)=="Admin")?true:false;
        $this->file = 'src/view/'.$template.'.php';
        //1- Construit le template avec les valeurs
        $this->content = $this->content . $this->renderFile($this->file, $data);
        //2- Rajoute le masque général + titre
        if ($display)
        {
            $view = $this->renderFile('src/view/Base.php', [
                'title' => $this->title,
                'admin' => $this->admin,
                'content' => $this->content]);
            echo $view;
        }
    }

    /**
     * Extrat the content of the page
     *
     * @param $file
     * @param $data
     * @return string
     */
    private function renderFile($file, $data)
    {
        if(file_exists($file)){
            if(isset($data)){extract($data);}
            $admin = $this->admin;
            //les données sont sous formes de tableau
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else {
            echo 'Fichier inexistant';
        }
    }

    /**
     * Title
     *
     * @param $title
     */
    public function setTitle($title){
            $this->title=$title;
    }

}
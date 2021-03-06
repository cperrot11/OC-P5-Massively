<?php
namespace App\src\FORM;

class PictureSizeValidator extends Validator
{
  protected $maxSize;
  protected $actualSize;

  
  public function __construct($errorMessage, $maxSize, $actualSize)
  {
    parent::__construct($errorMessage);
    $this->setMaxSize($maxSize);
    $this->setActualSize($actualSize);
  }
  
  public function isValid($file)
  {
      $file = $this->request->get('file');
      if (!isset($file)) {return true;}
      $tab_error = array(0,4);//ok ou pas de fichier
      $error = in_array($file['picture']['error'],$tab_error);
      return ($this->actualSize <= $this->maxSize) and $error;
  }
  
  public function setMaxSize($maxSize)
  {
    $maxSize = (int) $maxSize;
    
    if ($maxSize > 0)
    {
      $this->maxSize = $maxSize;
    }
    else
    {
      throw new \RuntimeException('La taille maximale doit être un nombre supérieur à 0');
    }
  }
    /**
     * @return mixed
     */
    public function getActualSize()
    {
        return $this->actualSize;
    }

    /**
     * @param mixed $actualSize
     */
    public function setActualSize($actualSize)
    {
        $this->actualSize = $actualSize;
    }
}
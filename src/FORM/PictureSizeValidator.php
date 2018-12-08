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
      return ($this->actualSize <= $this->maxSize) and ($_FILES['picture']['error']===0);
      //up_load_max_filesize = 2Mo php.ini (error=1)!!!
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
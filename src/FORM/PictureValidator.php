<?php
namespace App\src\FORM;

class PictureValidator extends Validator
{
    protected $extension;

    public function __construct($errorMessage)
      {
        parent::__construct($errorMessage);
      }
  
  public function isValid($file)
  {
      if(isset($_FILES))
      {
          $infosfichier = pathinfo($_FILES['picture']['name']);
          $extension_upload = $infosfichier['extension'];
          $extension_upload = strtoupper($extension_upload);
          $extensions_autorisees = array('JPG', 'JPEG', 'GIF', 'PNG', 'BMP');
          if (in_array($extension_upload, $extensions_autorisees))
          {
              return true;
          }
          else
          {
              $_SESSION['error']="Extension non conforme";
              return false;
          }
      }
      return true;
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
    /**
    * @return mixed
    */
    public function getExtension()
    {
        return $this->extension;
    }/**
    * @param mixed $extension
    */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
}
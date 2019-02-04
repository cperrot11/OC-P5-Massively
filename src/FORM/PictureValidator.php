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
      $file = $this->request->get('file');
      if (!isset($file) or $file['picture']['error']===4) {return true;}

      $infosfichier = pathinfo($file['picture']['name']);
      $extension_upload = $infosfichier['extension'];
      $extension_upload = strtoupper($extension_upload);
      if (in_array($extension_upload, EXTENSION))
          {
              return true;
          }
      $text1="Extension non conforme";
      $this->request->set('session', 'error', $text1);
      return false;
  }
  
  public function setMaxSize($maxSize)
  {
    $maxSize = (int) $maxSize;
    
    if ($maxSize > 0)
    {
      return $this->maxSize = $maxSize;
    }
    $text1 = 'La taille maximale doit être un nombre supérieur à 0';
    throw new \RuntimeException($text1);
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
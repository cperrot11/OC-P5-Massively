<?php
namespace App\src\FORM;

use App\config\Request;

abstract class Validator
{
  protected $errorMessage;
  protected $request;
  
  public function __construct($errorMessage)
  {
    $this->setErrorMessage($errorMessage);
    $this->request = new Request();
  }
  
  abstract public function isValid($value);
  
  public function setErrorMessage($errorMessage)
  {
    if (is_string($errorMessage))
    {
      $this->errorMessage = $errorMessage;
    }
  }
  
  public function errorMessage()
  {
    return $this->errorMessage;
  }
}
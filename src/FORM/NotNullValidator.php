<?php
namespace App\src\FORM;

class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != '';
  }
}